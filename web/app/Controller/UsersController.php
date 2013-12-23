<?php
class UsersController extends AppController {

	/**
	*	Liste les utilisateurs
	*/
	public function admin_index(){
		$listUser = $this->User->find('all');
		$this->set('listUser', $listUser);
	}


	/**
	*	Page de choix entre administrateur et opérateur
	*/
	public function admin_choice(){
		$this->layout = 'blank';
	}

	/**
	*	Formulaire d'édition d'un utilisateur
	*/
	public function admin_edit($id){
			if(!empty($this->data)){
				$this->User->id = $id;			
				$this->request->data = array('User' => $this->request->data);	
				
				if($this->User->save($this->data)){
					$this->Session->setFlash('<strong>Félicitation:</strong> Vous venez de mettre à jour un utilisateur !','message',
																				array('type' => 'success'));
					$this->redirect(array('action' => 'index'));
				}
			}else{
					$this->data = $this->User->findById($id, array('username', 'status', 'id'));
			}
			$this->set('typeUtil',$this->data['User']['status']);
	}

	/**
	*	Permet la suppression d'un utilisateur
	*/
	public function admin_delete($id){
		if($this->User->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un utilisateur !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}else{
				$this->Session->setFlash('<strong>Erreur:</strong> C\'est le dernier des administrateurs, il ne peut pas être supprimé','message',
																		 array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
			
		}
	}



	/**
	*	Formulaire d'ajout d'un utilisateur
	*/
	public function admin_add(){
		if(!empty($this->data)){
			unset($this->request->data['submit']);
			$this->request->data = array('User' => $this->request->data);

			if($this->User->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong> Vous venez d\'ajouter un utilisateur !','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	/**
	*	Connexion d'un utilisateur
	*/
	public function login() {
		$this->layout = 'blank';
		if(!empty($this->data)){
			if($this->Auth->login()){
				$this->Session->setFlash('Vous êtes connecté', 'message', array('type' => 'success'));
				if($this->Auth->user('status') == 'admin'){
					$this->redirect(array('controller' => 'users', 'action' => 'choice', 'admin' => true));
				}else{
					$this->redirect(array('controller' => 'transactions', 'action' => 'sale', 'admin' => false));
				}
			}
		}
	}


	/**
	*	Deconnexion d'un utilisateur et redirection vers la page de login
	*/
	public function logout(){
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}
}
?>