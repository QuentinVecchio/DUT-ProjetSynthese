<?php
class TransactionsController extends AppController {

	public function sale(){
			$this->loadModel('grade');
			$this->loadModel('sector');

			$this->set('listFiliere',$this->sector->find('all'));

			$this->loadModel('conditions');
			$this->set('test',$this->conditions->find('all'));
			if(!empty($this->data)){
				debug($this->data);
			}
	}

	public function getLivre($filiere = null, $classe = null){
			$this->loadModel('book');
			debug($this->book->find('all'));
	}

	public function getGrades($id){
		$this->loadModel('grade');
		echo json_encode($this->grade->find('all', array('conditions' => array('sector_id' => $id), 'recursive' => -1)));
		$this->layout = null;
		$this->autoRender = false;
	}

	public function getBooks($id){
		$this->loadModel('book');
		echo json_encode($this->book->find('all', array('fields' => array('Book.id, Book.name, Book.prize, Subject.name'), 'conditions' => array('grade_id' => $id))));
		$this->layout = null;
		$this->autoRender = false;
	}

	public function init(){
		$this->set('step_for_progress_bar', 1);
		if(!$this->Session->check('Transaction.date')){
			$this->Session->write('Transaction.date', time());
		}
	}

}
?>