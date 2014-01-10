<?php
class TransactionsController extends AppController {


	/**
	*	Permet de lister les factures
	*/
	public function admin_index(){
		$this->Transaction->unbindModel(array('hasMany' => array('Row'), 'hasAndBelongsToMany' => array('Typereglement')));
		$this->Transaction->recursive = 2;
		$this->set('list', $this->Transaction->find('all'));
	}


	/**
	*	Visualisation d'une facture
	*/
	public function admin_view($facture_id) {
		if(!is_numeric($facture_id) || is_numeric($facture_id) <= 0){
			$this->redirect(array('controller' => 'transactions', 'action' => 'index'));
		}

		$facture = $this->Transaction->findById($facture_id);
		if(empty($facture)){
			$this->redirect(array('controller' => 'transactions', 'action' => 'index'));
		}

		$this->set('facture', $facture);

	}

	/**
	*	Procéssus Vente
	*	Etape: 1
	*	Initialisation de la vente
	*/
	public function initSale($clientID = null){

		$step_succ =  array('controller' => 'transactions', 'action' => 'sale');

		$this->set('step_for_progress_bar', 1);
		$this->set('pred_for_progress_bar', '#');
		$this->set('suiv_for_progress_bar', $step_succ);


		if(!$this->Session->check('Transaction.achat')){
			$this->Session->write('Transaction.achat.step', 1);
		}

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.achat.Client')){
				$this->Transaction->recursive = 2;
				$this->Transaction->unbindModel(array('hasMany' => array('Row'), 'hasAndBelongsToMany' => array('Typereglement')));

				$client = $this->Transaction->Client->findById($clientID);
				if($client){
					$this->Session->write('Transaction.achat.Client', $client['Client']);
					$this->Session->write('Transaction.achat.Town', $client['Town']);

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
					$this->redirect($step_succ);

				}
			}
		}

		$listEnCours = $this->Transaction->findAllByCompletedAndType(0, 'achat');
		$this->set('listEnCours', $listEnCours);


	}

	/**
	*	Procéssus Vente
	*	Etape: 2	
	*	Etape de vente des livres
	*/
	public function sale($clientID = null){

		$step_pred = array('controller' => 'transactions', 'action' => 'initSale');


		if(!$this->Session->check('Transaction.achat') || $this->Session->read('Transaction.achat.step') < 2){
			$this->redirect($step_pred);
		}

		$step_succ = array('controller' => 'transactions', 'action' => 'reglement');
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', $step_pred);		
		$this->set('suiv_for_progress_bar', $step_succ);		

		if(!empty($this->data)){
			$this->Transaction->Row->deleteAll(array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')));
			if($this->Transaction->Row->saveMany($this->data)){

				$total = 0;
				foreach ($this->data as $key => $value) {
					$total += $value['Row']['prize_total'];
				}
				$this->Session->write('Transaction.achat.total', $total);

				$this->Session->write('Transaction.achat.step', 3);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
			$listAchat = $this->data;
		}else{
			$listAchat = $this->Transaction->Row->find('all', array('conditions' => array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')),
																	'recursive' => -1));
			
		}

		//Transaction pour angularjs
		foreach ($listAchat as $key => $value) {
			$listAchat[$key]['Row']['amount'] = intval($listAchat[$key]['Row']['amount']);
			$listAchat[$key]['Row']['Condition']['Condition'] = current($this->Transaction->Row->Condition->findById($listAchat[$key]['Row']['condition_id']));
		}


		$this->set('listAchat', $listAchat);
		$this->set('listFiliere', $this->Transaction->Row->Book->Subject->Grade->Sector->find('all'));
		$this->set('listCondition', $this->Transaction->Row->Condition->find('all'));

	}

	/**
	*	Processus Vente
	*	Etape: 3
	*	Choix des règlements
	*/
	public function reglement(){
		$step_pred = array('controller' => 'transactions', 'action' => 'sale');
		$step_succ = array('controller' => 'transactions', 'action' => 'recapSale');

		if(!empty($this->data)){

			// On enlève les entrées avec un prix vide
			foreach ($this->request->data as $key => $value) {
				if(empty($value['amount'])){
					unset($this->request->data[$key]);
				}
			}

			$this->Transaction->TransactionsTypereglement->deleteAll(array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')));
			if($this->Transaction->TransactionsTypereglement->saveMany($this->data)){
				$this->Session->write('Transaction.achat.step', 4);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
		}

		if(!$this->Session->check('Transaction.achat') || $this->Session->read('Transaction.achat.step') < 3){
			$this->redirect($step_pred);
		}
		
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', $step_succ);


		$this->loadModel('Typereglement');
		$listTypeReglement = $this->Typereglement->find('all', array('contain' => array('TransactionsTypereglement' => array(
																							'conditions' => array('transaction_id'=> $this->Session->read('Transaction.achat.transaction_id'))))));		
		foreach ($listTypeReglement as $key => $value) {
			if(!empty($value['TransactionsTypereglement']))
			$listTypeReglement[$key]['TransactionsTypereglement'][0]['amount'] = floatval($listTypeReglement[$key]['TransactionsTypereglement'][0]['amount']);
		}
		$this->set('listTypeReglement', $listTypeReglement);

	}



	/**
	*	Procéssus Vente
	*	Etape: 4	
	*	Récapitulation des achats du parent
	*/
	public function recapSale(){
		$step_pred =  array('controller' => 'transactions', 'action' => 'reglement');
		if(!$this->Session->check('Transaction.achat') || $this->Session->read('Transaction.achat.step') < 4){
			$this->redirect($step_pred);
		}
		
		$step_succ =  array('controller' => 'transactions', 'action' => 'end');
		$this->set('step_for_progress_bar', 4);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar',  $step_succ);

		$this->Transaction->TransactionsTypereglement->bindModel(array('belongsTo' => array('Typereglement')));
		$this->set('transactions',$this->Transaction->TransactionsTypereglement->findAllByTransactionId($this->Session->read('Transaction.achat.transaction_id')));


		$this->Transaction->Row->recursive =  -1;
		$listAchat = $this->Transaction->Row->findAllByTransactionId($this->Session->read('Transaction.achat.transaction_id'));
		$this->set('listLivre', $listAchat);

		$this->set('listCondition', $this->Transaction->Row->Condition->find('all'));


	}


	public function end(){
		$step_pred =  array('controller' => 'transactions', 'action' => 'reglement');

		if(!$this->Session->check('Transaction.achat') || $this->Session->read('Transaction.achat.step') < 4){
			$this->redirect($step_pred);
		}
		
		$this->set('step_for_progress_bar', 4);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar',  '#');

		$this->Transaction->id = $this->Session->read('Transaction.achat.transaction_id');
		if($this->Transaction->save(array('completed' => 1))){
			$this->Session->setFlash('Vente terminée','message', array('type' => 'success'));
		}else{
			$this->Session->setFlash('Erreur','message', array('type' => 'warning'));
		}
		$this->Session->delete('Transaction.achat');



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
		$this->Session->delete('Transaction');
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
	*	Suppression d'une transaction
	*/
	public function deleteTransactionSale($id) {
		if($this->Transaction->delete($id)){
			$this->Session->setFlash('Vous venez de supprimer une vente','message', array('type' => 'warning'));
		}else{
			$this->Session->setFlash('Erreur lors de la suppression','message', array('type' => 'danger'));
		}
		$this->redirect(array('controller' => 'transactions', 'action' => 'initSale'));
	}

	/**
	*	Reprise d'une transaction
	*/
	public function resume($id){
		$this->Transaction->recursive = 2;
		$this->Transaction->unbindModel(array('hasMany' => array('Row'), 'hasAndBelongsToMany' => array('Typereglement')));
		$tmp = $this->Transaction->findById($id);
		$this->Session->write('Transaction.achat.Client', $tmp['Client']);
		$this->Session->write('Transaction.achat.Town', $tmp['Client']['Town']);
		$this->Session->write('Transaction.achat.transaction_id', $id);
		$this->Session->write('Transaction.achat.step', 2);
		$this->redirect(array('controller'=> 'transactions', 'action' => 'sale'));
		
	}


	/**
	*	Reinitialise le panier
	*/
	public function refresh(){

		if($this->Session->check('Transaction.achat')){
			if($this->Session->check('Transaction.achat.transaction_id')){
				$tmp = $this->Transaction->findById($this->Session->read('Transaction.achat.transaction_id'));
				if($tmp){
					if($tmp['Transaction']['completed'] == 0){
						if($this->Transaction->delete($tmp['Transaction']['id'])){
							$this->Session->setFlash('Vous venez d\'annuler une vente','message', array('type' => 'warning'));
						}
					}
				}
			}
			$this->Session->delete('Transaction');
			$this->redirect(array('controller' => 'transactions', 'action' => 'initSale'));	
		}else if($this->Session->check('Transaction.depot')){
			if($this->Session->check('Transaction.depot.transaction_id')){
				$tmp = $this->Transaction->findById($this->Session->read('Transaction.depot.transaction_id'));
				if($tmp){
					if($tmp['Transaction']['completed'] == 0){
						if($this->Transaction->delete($tmp['Transaction']['id'])){
							$this->Session->setFlash('Vous venez d\'annuler un dépôt','message', array('type' => 'warning'));
						}
					}
				}
			}

			$this->Session->delete('Transaction');
			$this->redirect(array('controller' => 'transactions', 'action' => 'init'));	
		}

	}



	/**
	*	Quelques appels ajax pour les différentes étapes
	*/

	public function getGrades($id){
		$this->autoRender = false;
		echo json_encode($this->Transaction->Row->Book->Subject->Grade->find('all', array('conditions' => array('sector_id' => $id), 'recursive' => -1)));
	}

	public function getBooks($id){
		$this->autoRender = false;
		echo json_encode($this->Transaction->Row->Book->find('all', array('fields' => array('Book.id, Book.name, Book.prize, Subject.name'), 'conditions' => array('grade_id' => $id))));
	}
}
?>