<?php
class TransactionsController extends AppController {

	/**
	*	Procéssus Vente
	*	Etape: 1
	*	Initialisation de la vente
	*/
	public function initSale(){
		$this->set('step_for_progress_bar', 1);
		$this->set('pred_for_progress_bar', '#');
		$this->set('suiv_for_progress_bar', array('controller' => 'transactions', 'action' => 'sale'));



		if(!$this->Session->check('Transaction.date')){
			$this->Session->write('Transaction.date', time());
		}
	}

	/**
	*	Procéssus Vente
	*	Etape: 2	
	*	Etape de vente des livres
	*/
	public function sale($clientID = null){
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', array('controller' => 'transactions', 'action' => 'initSale'));		
		$this->set('suiv_for_progress_bar', array('controller' => 'transactions', 'action' => 'recapSale'));		
		

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.Client')){
				$client = current(current($this->Transaction->Client->find('all', array('conditions' => array('id' => $clientID)
																		,'recursive' => -1))));
				if($client){
					$this->Session->write('Transaction.Client', $client);
				}
			}
		}

		if(!$this->Session->check('Transaction.Client')){
			$this->redirect(array('controller' => 'transactions', 'action' => 'initSale'));
		}



		$this->loadModel('row');
		$this->loadModel('sector');

		$this->set('listFiliere',$this->sector->find('all'));

		$this->loadModel('conditions');
		$this->set('test',$this->conditions->find('all'));
		if(!empty($this->data)){
			$this->Session->write('Transaction.Row', $this->data['Row']);
			$this->redirect(array('controller' => 'transactions', 'action' => 'recapSale'));
		}
	}


	/**
	*	Procéssus Vente
	*	Etape: 3	
	*	Récapitulation des achats du parent
	*/
	public function recapSale(){
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', array('controller' => 'transactions', 'action' => 'sale'));
		$this->set('suiv_for_progress_bar', '#');

		if(!$this->Session->check('Transaction.Row')){
			$this->redirect(array('controller' => 'transactions', 'action' => 'sale'));
		}
	}



	/**
	*	Procéssus Dépot
	*	Etape: 1	
	*	Récapitulation des achats du parent
	*/
	public function init(){
		$this->set('step_for_progress_bar', 1);
		$this->set('pred_for_progress_bar', '#');
		$this->set('suiv_for_progress_bar', array('controller' => 'transactions', 'action' => 'depot'));



		if(!$this->Session->check('Transaction.date')){
			$this->Session->write('Transaction.date', time());
		}
	}

	/**
	*	Procéssus Dépot
	*	Etape: 1		
	*	Etape du dépôt des livres
	*/
	public function depot($clientID = null){
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', array('controller' => 'transactions', 'action' => 'init'));		
		$this->set('suiv_for_progress_bar', '#');		
		

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.Client')){
				$client = current(current($this->Transaction->Client->find('all', array('conditions' => array('id' => $clientID)
																		,'recursive' => -1))));
				if($client){
					$this->Session->write('Transaction.Client', $client);
				}
			}
		}

		if(!$this->Session->check('Transaction.Client')){
			$this->redirect(array('controller' => 'transactions', 'action' => 'init'));
		}
	}

	/**
	*	Reinitialise le panier
	*/
	public function refresh(){
		$this->Session->delete('Transaction');
		$this->redirect(array('controller' => 'transactions', 'action' => 'init'));
	}



	/**
	*	Quelques appels ajax pour les différentes étapes
	*/

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
}
?>