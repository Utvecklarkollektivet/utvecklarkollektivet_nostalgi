<?php
App::uses('AppController', 'Controller');
/**
 * RegisterKeys Controller
 *
 * @property RegisterKey $RegisterKey
 */
class RegisterKeysController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->RegisterKey->recursive = 0;
        $this->set('registerKeys', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->RegisterKey->id = $id;
        if (!$this->RegisterKey->exists()) {
            throw new NotFoundException(__('Invalid register key'));
        }
        $this->set('registerKey', $this->RegisterKey->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->RegisterKey->create();
            if ($this->RegisterKey->save($this->request->data)) {
                $this->Session->setFlash(__('The register key has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The register key could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->RegisterKey->id = $id;
        if (!$this->RegisterKey->exists()) {
            throw new NotFoundException(__('Invalid register key'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RegisterKey->save($this->request->data)) {
                $this->Session->setFlash(__('The register key has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The register key could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->RegisterKey->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->RegisterKey->id = $id;
        if (!$this->RegisterKey->exists()) {
            throw new NotFoundException(__('Invalid register key'));
        }
        if ($this->RegisterKey->delete()) {
            $this->Session->setFlash(__('Register key deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Register key was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
