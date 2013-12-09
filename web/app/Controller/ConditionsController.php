<?php 
class ConditionsController extends AppController{
	/**
	*	Liste les état
	*/
	public function admin_index(){
		$listEtat = $this->Condition->find('all');
		$this->set('listEtat', $listEtat);
	}

	/**
	*	Formulaire d'ajout d'un état
	*/
	public function admin_add(){
		if(!empty($this->data)){

			if($this->Condition->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez d\'ajouter un état','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	/**
	*	Formulaire d'édition d'un état
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Condition->id = $id;
			if($this->Condition->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez de mettre à jour un état','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->data = $this->Condition->findById($id);
		}
	}


	/**
	*	Permet la suppression d'un état
	*/
	public function admin_delete($id){
		if($this->Condition->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un état !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}
	}
} ?>