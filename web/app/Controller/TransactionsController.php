<?php
class TransactionsController extends AppController {

	public function sale(){
			$this->loadModel('grade');
			$this->loadModel('sector');
			debug($this->grade->find('list'));

			$this->set('listFiliere',$this->sector->find('list'));

			$this->loadModel('conditions');
			$this->set('test',htmlspecialchars(json_encode($this->conditions->find('all', array('fields' => array('name', 'reducing'))))));
	}

	public function getLivre($filiere = null, $classe = null){
			$this->loadModel('book');
			debug($this->book->find('all'));
	}

}
?>