<?php

class MenuComponent extends Component {

    public $components = array('Auth', 'Acl');

    public function generateMenu($menuArray) {

        $menu = array();
        $user = array('model' => 'User', 'foreign_key' => $this->Auth->User('id'));

        foreach ($menuArray as $item => $options) {

            if ($options['access'] === true ||
                $this->Acl->check($user, $options['access'])) {
                
                $submenu = array();
                if (!isset($options['submenu'])) {
                    $options['submenu'] = array();
                }

                foreach ($options['submenu'] as $subItem => $subOptions) {
                    if ($subOptions['access'] === true ||
                        $this->Acl->check($user, $subOptions['access'])) {
                        
                        $submenu[$subItem] = $subOptions;
                    }
                }
            
                $menu[$item] = $options;
                $menu[$item]['submenu'] = $submenu;
            }
        }

        return $menu;

    }

}

?>
