<?php 
class SectorsController extends AppController{
	/**
	*	Liste les filières
	*/
	public function admin_index(){
		$listFiliere = $this->Sector->find('all');
		$this->set('listFiliere', $listFiliere);
	}

	/**
	*	Formulaire d'ajout d'une filière
	*/
	public function admin_add(){
		if(!empty($this->data)){

			if($this->Sector->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez d\'ajouter une filière','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	/**
	*	Formulaire d'édition d'une filière
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Sector->id = $id;
			if($this->Sector->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong>Vous venez de mettre à jour une filière','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->data = $this->Sector->findById($id);
		}
	}


	/**
	*	Permet la suppression d'une filière
	*/
	public function admin_delete($id){
		if($this->Sector->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer une filière !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}
	}
}
 ?>