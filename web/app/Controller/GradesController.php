<?php 
class GradesController extends AppController{
	
	/**
	*	Liste les classes
	*/
	public function admin_index($id){
		$listGrade = $this->Grade->findAllBySectorId($id);
		$this->set('listGrade', $listGrade);
		$this->set('idGrade', $id);
		$this->set('info', $this->Grade->Sector->find('first', array('conditions' => array('Sector.id' => $id))));
	}

	/**
	*	Ajoute une classe dans une filière donnée
	*/
	public function admin_add($idSector){
		if(!empty($this->data)){
			$this->request->data = array('Grade' => $this->request->data);	
			$this->request->data['Grade']['sector_id'] = $idSector;
			if($this->Grade->save($this->data)){
				$this->Session->setFlash('Classe ajoutée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'grades', 'action' => 'index', $this->data['Grade']['sector_id']));
			}
		}
		$this->set('idSector', $idSector);
	}

	/**
	*	Edition d'une classe
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->request->data = array('Grade' => $this->request->data);
			$this->Grade->id = $id;
			if($this->Grade->save($this->data)){
				$this->Session->setFlash('Classe modifiée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'grades', 'action' => 'index', $this->data['Grade']['sector_id']));
			}
		}else{
			$this->data = $this->Grade->findById($id);
		}
		$this->set('idSector', $id);
	}


	/**
	*	Suppression d'une classe
	*/
	public function admin_delete($id){
		$idSector = $this->Grade->findById($id);
		$idSector = current($idSector);
		$idSector = $idSector['sector_id'];
		if($this->Grade->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer une classe !','message', array('type' => 'danger'));
				$this->redirect(array('controller' =>'grades', 'action' => 'index', $idSector));			
		}
	}

	/**
	*	Impression de la liste des classes
	*/
	public function admin_print($id) {
		$listGrade = $this->Grade->findAllBySectorId($id);
		$this->set('listGrade', $listGrade);
		$this->set('idGrade', $id);
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
	}
}
 ?>