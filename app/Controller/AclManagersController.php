<?php

class AclManagersController extends AppController {

	public function index() {

	}

	public function rewrite_acos() {
		if (!$this->request->is('post')) {
			$this->redirect(array('action' => 'index'));
		}
		$start = microtime(true);
		$this->AclManager->rewriteAcos($this->Acl);
		$this->set(
			'executionTime',
			(sprintf("%.9f", ceil( (microtime(true) - $start) * 1000) / 1000000000))
		);
	}

}

?>
