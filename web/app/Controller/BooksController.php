<?php 
class BooksController extends AppController{

	/**
	*	Liste les livres d'une matière donnée
	*/
	public function admin_index($id, $idMatiere){
		$listLivre = $this->Book->findAllBySubjectId($id);
		$this->set('listLivre', $listLivre);
		$this->set('idMatiere', $idMatiere);		
		$this->set('idSubject', $id);		
		$this->set('info', $this->Book->Subject->find('first', array('conditions' => array('Subject.id' => $id), 'recursive' => 2)));
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
		$this->set('idGrade', $idGrade);
		$subject = $this->Book->Subject->findById($idGrade);
		$this->set('subject', $subject);

		if(!empty($this->data)){

			$this->request->data = array('Book' => $this->request->data);	
			$this->request->data['Book']['subject_id'] = $idGrade;

			if($this->Book->save($this->data)){

				/* On construit les lignes nécessaires pour le stocks, tout a 0*/
				$this->loadModel('Condition');
				$listCondition = $this->Condition->find('list');
				$stock = array();
				foreach ($listCondition as $key => $value) {
					$stock[$key]['condition_id'] = $key;
					$stock[$key]['book_id'] = $this->Book->id;
					$stock[$key]['depot'] = 0;
					$stock[$key]['vente'] = 0;
				}
				$this->loadModel('Stock');
				if($this->Stock->saveMany($stock)){
					$this->Session->setFlash('Livre ajouté avec succès', 'message', array('type' => 'success'));
					$this->redirect(array('controller' => 'books', 'action' => 'index', $this->data['Book']['subject_id'], $subject['Subject']['grade_id']));
				}else{
					$this->Session->setFlash('Erreur lors de l\'ajout du livre', 'message', array('type' => 'warning'));
				}
				
			}else{
				$this->request->data['Book']['prize'] = intval($this->data['Book']['prize']);
			}
		}
	}

	/**
	*	Modification d'un livre
	*/
	public function admin_edit($id){
		$this->set('idGrade', $id);
		$subject = $this->Book->Subject->findById($id);
		$this->set('subject', $subject);		
		if(!empty($this->data)){
			$this->Book->id = $id;
			$this->request->data = array('Book' => $this->request->data);				
			if($this->Book->save($this->data)){
				$this->Session->setFlash('Matière modifiée avec succès', 'message', array('type' => 'success'));
				$idSubject = current($this->Book->findById($id, array('subject_id')));
				$idSubject = $idSubject['subject_id'];

				$this->redirect(array('controller' => 'books', 'action' => 'index', $idSubject, $subject['Subject']['grade_id']));
			}
		}else{
			$this->data = $this->Book->findById($id);
		}
		$this->request->data['Book']['prize'] = intval($this->data['Book']['prize']);
	}

	/**
	*	Suppression d'un livre
	*/
	public function admin_delete($id){
		$idSubject = current($this->Book->findById($id, array('subject_id')));
		$idSubject = $idSubject['subject_id'];
		$subject = $this->Book->Subject->findById($id);
		$this->set('subject', $subject);	
		if($this->Book->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer un livre !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index', $idSubject, $subject['Subject']['grade_id']));			
		}
	}

	/**
	*	Permet l'impression de toutes les livres
	*/
	public function admin_print($id = null)
	{
		$listLivre = $this->Book->findAllBySubjectId($id);
		$this->set('listLivre', $listLivre);
		$this->set('idSubject', $id);		
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();    
    }

} ?>