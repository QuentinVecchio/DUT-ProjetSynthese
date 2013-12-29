<?php 
class ClientsController extends AppController{

	/**
	*	Liste les parents
	*/
	public function admin_index(){
		$listParent = $this->Client->find('all');
		$this->set('listParent', $listParent);
	}

	/**
	*	Formulaire d'ajout d'une parent
	*/
	public function add(){
		if(!empty($this->data)){
			$this->request->data = array('Client' =>$this->data);			
			if($this->Client->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez d\'ajouter un parent','message', array('type' => 'success'));
				
				if($this->Session->check('Transaction') && !$this->Session->check('Transaction.Client')){
					$this->redirect(array('controller' => 'transactions', 'action' => 'depot', 'admin' => false, $this->Client->id));	
				}else{
					$this->redirect(array('action' => 'index', 'admin' => true));
				}
			}
			if(isset($this->data['Client']['town_id'])){
				$this->request->data['Town'] = current($this->Client->Town->findById($this->data['Client']['town_id']));
			}			
		}

		$listAssoc = $this->Client->Association->find('list');
		$this->set('listAssoc', $listAssoc);
	}

	/**
	*	Formulaire d'édition d'un parent
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Client->id = $id;
			if($this->Client->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez de mettre à jour les informations d\'un parent','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->data = $this->Client->findById($id);
		}

		$listAssoc = $this->Client->Association->find('list');
		$this->set('listAssoc', $listAssoc);
	}


	/**
	*	Permet la suppression d'un parent
	*/
	public function admin_delete($id){
		if($this->Client->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un parent !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}
	}

	public function getClient($name){
		$this->autoRender = false;
		echo json_encode($this->Client->find('all', array('conditions' => array('OR' => array('Client.name LIKE' => $name.'%',
																							   'Client.lastname LIKE' => $name.'%')
																				))));
	}
}
 ?>