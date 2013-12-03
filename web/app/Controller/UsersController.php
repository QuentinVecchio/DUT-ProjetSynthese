<?php
class UsersController extends AppController {

	public function login() {
		if(!empty($this->data)){
			if($this->Auth->login()){
				$this->Session->setFlash('Vous êtes connecté', 'message', array('type' => 'success'));
			}
		}
	}
}
?>