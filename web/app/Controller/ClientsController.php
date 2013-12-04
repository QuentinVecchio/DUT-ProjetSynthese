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
	public function admin_add(){
		if(!empty($this->data)){

			if($this->Client->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez d\'ajouter un parent','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
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


}
 ?>