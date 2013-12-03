<?php
class UsersController extends AppController {

	/**
	*	Connexion d'un utilisateur
	*/
	public function login() {
		if(!empty($this->data)){
			if($this->Auth->login()){
				$this->Session->setFlash('Vous êtes connecté', 'message', array('type' => 'success'));
				$this->redirect('/');
			}
		}
	}


	/**
	*	Deconnexion d'un utilisateur et redirection vers la page de login
	*/
	public function logout(){
		$this->Auth->logout();
		$this->redirect(array('controller' => 'User', 'action' => 'login'));
	}
}
?>