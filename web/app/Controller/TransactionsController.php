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



		if(!$this->Session->check('Transaction.achat.date')){
			$this->Session->write('Transaction.achat.date', time());
			$this->Session->write('Transaction.achat.type', 'achat');
		}
	}

	/**
	*	Procéssus Vente
	*	Etape: 2	
	*	Etape de vente des livres
	*/
	public function sale($clientID = null){
		$step_pred = array('controller' => 'transactions', 'action' => 'initSale');
		$step_succ = array('controller' => 'transactions', 'action' => 'recapSale');
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', $step_pred);		
		$this->set('suiv_for_progress_bar', $step_succ);		
		

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.achat.Client')){
				$client = current(current($this->Transaction->Client->find('all', array('conditions' => array('id' => $clientID)
																		,'recursive' => -1))));
				if($client){
					$this->Session->write('Transaction.achat.Client', $client);
				}
			}
		}

		if(!$this->Session->check('Transaction.achat.Client')){
			$this->redirect($step_pred);
		}



		$this->loadModel('row');
		$this->loadModel('sector');

		$this->set('listFiliere',$this->sector->find('all'));

		$this->loadModel('conditions');
		$this->set('test',$this->conditions->find('all'));
		if(!empty($this->data)){
			$this->Session->write('Transaction.achat.Row', $this->data['Row']);
			$this->redirect($step_succ);
		}
	}


	/**
	*	Procéssus Vente
	*	Etape: 3	
	*	Récapitulation des achats du parent
	*/
	public function recapSale(){
		$step_pred =  array('controller' => 'transactions', 'action' => 'sale');
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', '#');

		if(!$this->Session->check('Transaction.achat.Row')){
			$this->redirect($step_pred);
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



		if(!$this->Session->check('Transaction.depot.date')){
			$this->Session->write('Transaction.depot.date', time());
			$this->Session->write('Transaction.depot.type', 'depot');			
		}
	}

	/**
	*	Procéssus Dépot
	*	Etape: 2		
	*	Etape du dépôt des livres
	*/
	public function depot($clientID = null){
		
		if(!$this->Session->check('Transaction.depot.Client')){
			$this->redirect($step_pred);
		}

		$step_pred = array('controller' => 'transactions', 'action' => 'init');
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', $step_pred);		
		$this->set('suiv_for_progress_bar', '#');		
		

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.depot.Client')){
				$client = current(current($this->Transaction->Client->find('all', array('conditions' => array('id' => $clientID)
																		,'recursive' => -1))));
				if($client){
					$this->Session->write('Transaction.depot.Client', $client);
				}
			}
		}

	}

	/**
	*	Processus Dépôt
	*	Etape: 3
	*	Etape de la récapitulation
	*/
	public function recapDepot(){
		$step_pred = array('controller' => 'transactions', 'action' => 'depot');
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', '#');

		if(!$this->Session->check('Transaction.depot.Row')){
			$this->redirect($step_pred);
		}
	}




	/**
	*	Reinitialise le panier
	*	@params $type, le type de panier (sale ou depot)
	*/
	public function refresh($type){
		$this->Session->delete('Transaction');

		if($type == 'sale'){
			$this->redirect(array('controller' => 'transactions', 'action' => 'initSale'));	
		}else{
			$this->redirect(array('controller' => 'transactions', 'action' => 'init'));	
		}

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