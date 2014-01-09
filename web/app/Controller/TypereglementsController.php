<?php 
class TypereglementsController extends AppController{
	/**
	*	Liste des réglements
	*/
	public function admin_index(){
		$listType = $this->Typereglement->find('all');
		$this->set('listType', $listType);
	}

	/**
	*	Formulaire d'ajout d'un type de réglement
	*/
	public function admin_add(){
		if(!empty($this->data)){
			$this->request->data = array('Typereglement' => $this->request->data);	
			if($this->Typereglement->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation: </strong>Vous venez d\'ajouter un réglement','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	/**
	*	Formulaire d'édition d'un réglement
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Typereglement->id = $id;
			$this->request->data = array('Typereglement' => $this->request->data);	
			if($this->Typereglement->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation: </strong>Vous venez de mettre à jour un réglement','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->data = $this->Typereglement->findById($id);
		}
	}


	/**
	*	Permet la suppression d'un réglement
	*/
	public function admin_delete($id){
		if($this->Typereglement->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un réglement !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}
	}

	/**
	*	Impression de la liste des réglement
	*/
	public function admin_print() {
		$listType = $this->Typereglement->find('all');
		$this->set('listType', $listType);
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
	}
}
 ?>