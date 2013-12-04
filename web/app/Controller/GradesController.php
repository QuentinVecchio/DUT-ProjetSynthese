<?php 
class GradesController extends AppController{
	

	public function admin_index($id){
		$listGrade = $this->Grade->findAllBySectorId($id);
		$this->set('listGrade', $listGrade);
	}

	public function admin_add($idSector){
		if(!empty($this->data)){
			$this->request->data['Grade']['sector_id'] = $idSector;

			if($this->Grade->save($this->data)){
				$this->Session->setFlash('Classe ajoutée avec succès', 'message', array('type' => 'success'));
			}
		}
	}

	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Grade->id = $id;
			if($this->Grade->save($this->data)){
				$this->Session->setFlash('Classe modifiée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'grades', 'action' => 'index', $this->data['Grade']['sector_id']));
			}
		}else{
			$this->data = $this->Grade->findById($id);
		}
	}


	public function admin_delete($id){
		$idSector = $this->Grade->findById($id);
		$idSector = current($idSector)['sector_id'];
		if($this->Grade->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer une classe !','message', array('type' => 'danger'));
				$this->redirect(array('controller' =>'grades', 'action' => 'index', $idSector));			
		}
	}
}
 ?>