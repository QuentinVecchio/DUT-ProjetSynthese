<?php 
class BooksController extends AppController{

	public function admin_index($id){
		$listLivre = $this->Book->findAllById($id);
		$this->set('listLivre', $listLivre);
		$this->set('idSubject', $id);		
	}


	public function admin_add($idGrade){
		if(!empty($this->data)){
			$this->request->data['Book']['subject_id'] = $idGrade;
			debug($this->data);
			if($this->Book->save($this->data)){
				$this->Session->setFlash('Classe ajoutée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'book', 'action' => 'index', $this->data['Book']['subject_id']));
			}
		}
	}
} ?>