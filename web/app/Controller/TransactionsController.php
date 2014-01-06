<?php
class TransactionsController extends AppController {


	public function admin_index(){
		$this->set('list', $this->Transaction->find('all'));
	}





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
			$this->Session->write('Transaction.achat.completed', 0);
			$this->Session->write('Transaction.achat.close', 0);
		}
	}

	/**
	*	Procéssus Vente
	*	Etape: 2	
	*	Etape de vente des livres
	*/
	public function sale($clientID = null){
		$step_pred = array('controller' => 'transactions', 'action' => 'initSale');
		$step_succ = array('controller' => 'transactions', 'action' => 'reglement');
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', $step_pred);		
		$this->set('suiv_for_progress_bar', $step_succ);		
		

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.achat.Client')){
				$client = current($this->Transaction->Client->find('all', array('conditions' => array('Client.id' => $clientID))));
				if($client){
					debug($client);
					$this->Session->write('Transaction.achat.Client', $client['Client']);

					$tmp = array('client_id' => $client['Client']['id'],
								 'user_id' => $this->Auth->user('id'),
								 'date' => date('Y-m-d',time(null)),
								 'type' => 'achat',
								 'close' => 0,
								 'completed' => 0,
								 );
					$this->Transaction->save($tmp);
					$this->Session->write('Transaction.achat.transaction_id', $this->Transaction->id);
					$this->Session->write('Transaction.achat.step', 2);

				}
			}
		}

		if(!$this->Session->check('Transaction.achat.Client')){
			$this->redirect($step_pred);
		}


		if(empty($this->data)){

			$listAchat = $this->Transaction->Row->find('all', array('conditions' => array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')),
																	'recursive' => -1));

		}else{
			$listAchat = $this->data;
		}

		//Transaction pour angularjs
		foreach ($listAchat as $key => $value) {
			$listAchat[$key]['Row']['amount'] = intval($listAchat[$key]['Row']['amount']);
			$listAchat[$key]['Row']['Condition']['conditions'] = current($this->Transaction->Row->Condition->findById($listAchat[$key]['Row']['condition_id']));
		}


		$this->set('listAchat', $listAchat);




		
		/* les deux suivantes */
		$this->loadModel('sector');
		debug($this->sector->find('all'));
		$this->set('listFiliere',$this->sector->find('all'));
		//$this->set('listFiliere', $this->Transaction->Row->Book->Subject->Grade->Sector->find('all');



		/* Les deux suivantes */
		$this->loadModel('conditions');
		$this->set('test',$this->conditions->find('all'));
		//$this->set('listCondition', $this->Transaction->Row->Condition->find('all');




		if(!empty($this->data)){
			$this->Transaction->Row->deleteAll(array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')));
			if($this->Transaction->Row->saveMany($this->data)){
				$this->Session->write('Transaction.achat.Row', $this->data);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
		}
	}

	/**
	*	Processus Vente
	*	Etape: 3
	*	Choix des règlements
	*/
	public function reglement(){
		$step_pred = array('controller' => 'transactions', 'action' => 'sale');
		$step_succ = array('controller' => 'transactions', 'action' => 'recapSale');
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', $step_succ);


		$this->loadModel('Typereglement');
		$this->loadModel('TransactionsTypereglement');
		$listTypeReglement = $this->Typereglement->find('all', array('contain' => array('TransactionsTypereglement' => array(
																							'conditions' => array('transaction_id'=> $this->Session->read('Transaction.achat.transaction_id'))))));		
		$this->set('listTypeReglement', $listTypeReglement);

		if(!empty($this->data)){
			$this->TransactionsTypereglement->deleteAll(array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')));
			if($this->TransactionsTypereglement->saveMany($this->data)){
				$this->Session->setFlash('<strong>Félicitation: </strong>Vous venez d\'enregistrer','message', array('type' => 'success'));
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
			debug($this->data);
		}
	}



	/**
	*	Procéssus Vente
	*	Etape: 4	
	*	Récapitulation des achats du parent
	*/
	public function recapSale(){
		$step_pred =  array('controller' => 'transactions', 'action' => 'reglement');
		$step_succ =  array('controller' => 'transactions', 'action' => 'reglement');
		$this->set('step_for_progress_bar', 4);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar',  '#');

		if(!$this->Session->check('Transaction.achat.Row')){
			$this->redirect($step_pred);
		}

		$this->Transaction->Row->recursive =  -1;
		$listAchat = $this->Transaction->Row->findAllByTransactionId($this->Session->read('Transaction.achat.transaction_id'));
		$this->set('listLivre', $listAchat);

		$this->set('listCondition', $this->Transaction->Row->Condition->find('all'));


	}










	/**
	*	Procéssus Dépot
	*	Etape: 1	
	*	Initialisation du dépôt
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

		if(!$this->Session->check('Transaction.depot.Client')){
			$this->redirect($step_pred);
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
	*/
	public function refresh(){

		if($this->Session->check('Transaction.achat')){
			/*if($this->Session->check('Transaction.achat.transaction_id')){
				$tmp = $this->Transaction->findById($this->Session->read('Transaction.achat.transaction_id'));
				if($tmp){
					if($tmp['Transaction']['completed'] == 0){
						$this->Transaction->delete($tmp['Transaction']['id']);
					}
				}
			}*/
			$this->Session->delete('Transaction');
			$this->redirect(array('controller' => 'transactions', 'action' => 'initSale'));	
		}else{
			$this->Session->delete('Transaction');
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