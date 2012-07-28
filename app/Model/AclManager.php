<?php

App::uses('Sanitize', 'Utility');

class AclManager extends AppModel {

    public $useTable = false;

    /**
     * Returns all controller file names except AppController.php
     *
     * @access private
     * @return array
     */
    private function getControllerFiles() {
        $dir = opendir(dirname(__DIR__) . '/Controller/');

        if (!$dir) {
            throw new Exception('Error, could not read directory...');
        }

        $files = array();
        while (($file = readdir($dir)) !== false) {
            if (preg_match('/^(?!App).*Controller\.php$/', $file)) {
                $files[] = $file;
            }
        }

        return $files;
    }

    /**
     * Returns a multilevel array that contains Classes that contains all
     * methods of all files in /app/Controller/ excluding AppController.php.
     *
     * @access private
     * @return array
     */
    private function getControllers() {
        $controllerDir = dirname(__DIR__) . '/Controller/';
        require_once($controllerDir . 'AppController.php');
        $appMethods = get_class_methods(new AppController());

        $controllerFiles = $this->getControllerFiles();

        $methods = array();
        foreach($controllerFiles as $file) {
            require_once($controllerDir . $file);
            $class = substr($file, 0, -strlen('.php'));
            $classMethods = get_class_methods(new $class());

            foreach($classMethods as $method) {
                if (!in_array($method, $appMethods) && $method[0] != '_') {
                    $methods[$class][] = $method;
                }
            }
        }
        return array('controllers' => $methods);
    }

    /**
     * Returns an array of every class and method with values on id, parent_id,
     * lft and rght. WARNING! This works only with 2 level of groups in groups.
     *
     * @access private
     * @param array $controllers
     * @return array
     */
    private function getAcos($controllers) {
        $controllers = $this->getControllers();
        $acos = array();

        $id = 0;
        $traverseCnt = 1;

        foreach ($controllers as $root => $controller) {
            $current1 = $id++;
            $acos[$current1]['id'] = $id;
            $acos[$current1]['lft'] = $traverseCnt++;
            $acos[$current1]['parent_id'] = null;
            $acos[$current1]['alias'] = $root;
            $parent = $id;

            foreach ($controller as $class => $methods) {
                $current2 = $id++;
                $acos[$current2]['id'] = $id;
                $acos[$current2]['lft'] = $traverseCnt++;
                $acos[$current2]['parent_id'] = $parent;
                $acos[$current2]['alias'] = substr($class, 0, -strlen('Controller'));
                $parent2 = $id;

                foreach ($methods as $key => $name) {
                    $current3 = $id++;
                    $acos[$current3]['id'] = $id;
                    $acos[$current3]['lft'] = $traverseCnt++;
                    $acos[$current3]['rght'] = $traverseCnt++;
                    $acos[$current3]['parent_id'] = $parent2;
                    $acos[$current3]['alias'] = $name;
                }

                $acos[$current2]['rght'] = $traverseCnt++;
            }
            $acos[$current1]['rght'] = $traverseCnt++;
        }
        return $acos;
    }

    /**
     * Write all $acos to the database. WARNING! Multiple id will produce
     * errors! Take care of that before the acos array is sent to this
     * function.
     *
     * @access private
     * @param array $acos
     */
    private function writeAcos( $acos ) {
        $i = 0;

        $sql = 'INSERT INTO acos';
        $sql .= '   (`id`, `parent_id`, `alias`, `lft`, `rght`)'; 
        $sql .= 'VALUES';
      
        $sanitizer = new Sanitize();

        foreach ($acos as $values) {
            $id = intval($values['id']);
            $parent_id = intval($values['parent_id']);
            $alias = Sanitize::clean($values['alias']);
            $lft = intval($values['lft']);
            $rght = intval($values['rght']);
            
            if ($parent_id == 0) {
                $parent_id = 'NULL';
            }

            $i++;
            $sql .= "('$id', $parent_id, '$alias', '$lft', '$rght')";

            if ($i < count($acos)) {
                $sql .= ',';
            }
        }

        $this->query($sql);
    }

    /**
     * Write aros_acos with data from acl_permissions.
     *
     * @access private
     */
    private function writeArosAcos($acl) {
        $resultSet = $this->query(
           'SELECT acl.*, aros.model, aros.foreign_key FROM acl_permissions AS acl
            LEFT JOIN aros ON(aros.id = acl.aros_id)'
        );
        
        foreach ($resultSet as $row) {
            if ($row['acl']['permission'] == '1') {
                $acl->allow(array('model' => $row['aros']['model'], 'foreign_key' => $row['aros']['foreign_key']), $row['acl']['controller']);
            }
            else {
                //$acl->deny(array('model' => $row['aros']['model'], 'Aro.id' => $row['acl']['aros_id']), $row['acl']['controller']);
            }
        }
    }

    /**
     * Truncates acos
     *
     * @access private
     */
    private function truncateAcos() {
        //TRUNCATE TABLE not allowed when locked
        $this->query('DELETE FROM acos');
        $this->query('ALTER TABLE acos AUTO_INCREMENT = 1');
    }

    /**
     * Truncate aros_acos
     *
     * @access private
     */
    private function truncateArosAcos() {
        // TRUNCATE TABLE not allowed when locked
        $this->query('DELETE FROM aros_acos');
        $this->query('ALTER TABLE aros_acos AUTO_INCREMENT = 1');
    }

    /**
     * Write locks all acl tables(acos, aros, aros_acos, acl_persmissions)
     * until unlockAclTables() is called.
     */
    private function lockAclTables() {
        $this->query('LOCK TABLES acos WRITE, aros WRITE, 
                      aros_acos WRITE, acl_permissions AS acl READ,
                      aros AS Aro READ, aros AS Aro0 READ,
                      aros AS Aro1 READ,
                      acos AS Aco READ, acos AS Aco0 READ,
                      acos AS Aco1 READ,
                      aros_acos AS Permission WRITE');
    }

    /**
     * Unlocks all tables.
     */
    private function unlockAclTables() {
        $this->query('UNLOCK TABLES');
    }

    /**
     *
     */
    public function deleteGroupPermissions($groupID) {
        $groupID = intval($groupID);
        $result = $this->query("
            SELECT id 
            FROM aros WHERE model = 'Group' 
                AND foreign_key = '$groupID'
            LIMIT 1
        ");
        $aroID = $result[0]['aros']['id'];
        $this->query("DELETE FROM acl_permissions WHERE aros_id = '$aroID'");
        $this->query("DELETE FROM aros_acos WHERE aro_id = '$aroID'");
    }

    /**
     * Truncates the acos table and rewrite all acos. This also updates the
     * aros_acos relationship from acl_permissions table. This can be a heavy
     * operation on the database! Use when really nessecary!
     *
     * This operation locks all acl tables during the process to avoid that
     * users get wrong permissions during the write.
     */
    public function rewriteAcos($acl) {
        
        $controllers = $this->getControllers();
        $acos = $this->getAcos($controllers);
        
        $this->lockAclTables();
        $this->truncateAcos();
        $this->writeAcos($acos);
        $this->truncateArosAcos();
        $this->writeArosAcos($acl);
        $this->unlockAclTables();
    }


    /**
     * Get the groups permissions.
     *
     * @param integer The id of the group
     * @return array
     */
    public function getGroupPermissions($groupID) {
        $groupID = intval($groupID);

        $sql = "SELECT acos.alias, acos.id FROM aros
                LEFT JOIN aros_acos ON (aros_acos.aro_id=aros.id)
                LEFT JOIN acos ON (acos.id=aros_acos.aco_id)
                WHERE aros.foreign_key = '$groupID'";
        $permissions = $this->query($sql);

        $styledArray = array();
        foreach ($permissions as $permission) {
            $styledArray[$permission['acos']['id']] = $permission['acos']['alias'];
        }

        return $styledArray;
    }

    /**
     * Returns all acos
     */
    public function getAllAcos() {
        $sql = "SELECT acos.id, acos.alias, acos.parent_id FROM acos ORDER BY lft";
        $acos = $this->query($sql);
        return $acos;
    }

    /**
     * Set privilege.
     */
    public function setGroupPermission($acl, $groupID, $acoID, $allow = true) {
        $acoID = intval($acoID);
        $groupID = intval($groupID);
        $result = $this->query(
            "SELECT id FROM aros
             WHERE foreign_key = '$groupID'
                AND model = 'Group'
             LIMIT 1"
        );
        $aroID = $result[0]['aros']['id'];

        $result = $this->query(
            "SELECT a1.alias, a2.alias, a3.alias FROM acos AS a1
             LEFT JOIN acos AS a2 ON(a1.parent_id=a2.id)
             LEFT JOIN acos AS a3 ON(a2.parent_id=a3.id)
             WHERE a1.id = '$acoID'
             LIMIT 1"
        );

        $alias = $result[0]['a3']['alias'] ? $result[0]['a3']['alias'].'/':'';
        $alias .= $result[0]['a2']['alias'] ? $result[0]['a2']['alias'].'/':'';
        $alias .= $result[0]['a1']['alias'];


        debug($alias);

        $allowi = $allow ? '1' : '0';
        $this->query(
            "INSERT INTO acl_permissions(aros_id, controller, permission)
             VALUE('$aroID', '$alias', '$allowi')"
        );

        if ($allow) {
            $acl->allow(array('model' => 'Group', 'foreign_key' => $groupID), $alias);
        } else {
            $acl->deny(array('model' => 'Group', 'foreign_key' => $groupID), $alias);
        }
    }

    /**
     * Set privileges.
     */
    public function setGroupPermissions($acl, $groupID, $privileges) {
        foreach ($privileges as $acoID => $value) {
            if ($value == true) {
                $this->setGroupPermission($acl, $groupID, $acoID, true);
            }
        }
    }
}


?>
