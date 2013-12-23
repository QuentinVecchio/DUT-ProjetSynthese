<?php 
class BooksController extends AppController{

	/**
	*	Liste les livres d'une matière donnée
	*/
	public function admin_index($id = null){
		$listLivre = $this->Book->findAllBySubjectId($id);
		$this->set('listLivre', $listLivre);
		$this->set('idSubject', $id);		
	}

	/**
	*	Liste tout les livres
	*/
	public function index(){
			$listLivre = $this->Book->find('all');
			$this->set('listLivre', $listLivre);
	}


	/**
	*	Ajout d'un livre
	*/
	public function admin_add($idGrade){
		if(!empty($this->data)){
			$this->request->data['Book']['subject_id'] = $idGrade;
			if($this->Book->save($this->data)){
				$this->Session->setFlash('Classe ajoutée avec succès', 'message', array('type' => 'success'));
				$this->redirect(array('controller' => 'books', 'action' => 'index', $this->data['Book']['subject_id']));
			}
		}
	}

	/**
	*	Modification d'un livre
	*/
	public function admin_edit($id){
		if(!empty($this->data)){
			$this->Book->id = $id;
			if($this->Book->save($this->data)){
				$this->Session->setFlash('Matière modifiée avec succès', 'message', array('type' => 'success'));
				$idSubject = current($this->Book->findById($id, array('subject_id')));
				$idSubject = $idSubject['subject_id'];

				$this->redirect(array('controller' => 'books', 'action' => 'index', $idSubject));
			}
		}else{
			$this->data = $this->Book->findById($id);
		}
	}

	/**
	*	Suppression d'un livre
	*/
	public function admin_delete($id){
		$idSubject = current($this->Book->findById($id, array('subject_id')));
		$idSubject = $idSubject['subject_id'];
		if($this->Book->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un livre !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index', $idSubject));			
		}
	}



} ?>