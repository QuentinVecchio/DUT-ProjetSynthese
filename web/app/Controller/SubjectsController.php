<?php 
class SubjectsController extends AppController{
	public function admin_index($id){
		$listMatiere = $this->Subject->findAllByGradeId($id);
		$this->set('listMatiere', $listMatiere);
		$this->set('idSubject', $id);
	}

	public function admin_add($idSubject){
		if(!empty($this->data)){
			$this->request->data['Subject']['grade_id'] = $idSubject;

			if($this->Subject->save($this->data)){
				$this->Session->setFlash('Matière ajoutée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'subjects', 'action' => 'index', $this->data['Subject']['grade_id']));
			}
		}
	}

	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Subject->id = $id;
			if($this->Subject->save($this->data)){
				$this->Session->setFlash('Matière modifiée avec succès', 'message', array('type' => 'success'));
				$idSubject = current($this->Subject->findById($id, array('grade_id')));
				$idSubject = $idSubject['grade_id'];

				$this->redirect(array('controller' => 'subjects', 'action' => 'index', $idSubject));
			}
		}else{
			$this->data = $this->Subject->findById($id);
		}
	}



} ?>