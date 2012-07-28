<?php
App::uses('AppController', 'Controller');

/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

    /**
     * Standard paginate
     */
    public $paginate = array(
        'User' => array('limit' => 10) 
    );

    /**
     * index method
     */
    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     */
    public function view($id = null) {


        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->Group->recursive = 0;
        $this->paginate['User']['fields'] = array('User.id', 'User.username');
        $this->set('group', $this->Group->read(null, $id));
        $this->set('users', $this->paginate($this->Group->User, array('User.group_id' => $id)));

        $this->loadModel('AclManager');
        $this->set('groupPermissions', $this->AclManager->getGroupPermissions($id));
    }

    /**
     * add method
     */
    public function add() {

        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                
                $this->loadModel('AclManager');
                $this->AclManager->setGroupPermissions(
                    $this->Group->getInsertID(),
                    $this->request->data['Group']['permissions'] 
                );
                
                $this->redirect(array('action' => 'index'));
            }
        }

        $this->loadModel('AclManager');
        $this->set('acos', $this->AclManager->getAllAcos());

        $this->set('validationErrors', $this->Group->validationErrors);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     */
    public function edit($id = null) {
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Group->save($this->request->data)) {
                $this->loadModel('AclManager');
                $this->AclManager->deleteGroupPermissions($id);
                $this->AclManager->setGroupPermissions(
                    $this->Group->id,
                    $this->request->data['Group']['permissions'] 
                );
                $this->Session->setFlash(__('The group has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        } else {
            $this->Group->recursive = 0;
            $this->request->data = $this->Group->read(null, $id);
        }

        $this->loadModel('AclManager');
        $this->set('allowed', $this->AclManager->getGroupPermissions($id));
        $this->set('acos', $this->AclManager->getAllAcos());
        $this->set('validationErrors', $this->Group->validationErrors);
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->Group->delete()) {
            $this->redirect(array('action' => 'index'));
        }
        $this->redirect(array('action' => 'index'));
    }
}
