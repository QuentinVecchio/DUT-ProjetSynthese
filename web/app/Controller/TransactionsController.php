<?php
class TransactionsController extends AppController {


	/**
	*	Impression de la facture
	*/
	public function admin_print($facture_id) {
		$listType = $this->Transaction->find('all');
		$this->Transaction->Row->unbindModel(array('belongsTo' => array('Transaction', 'Book', 'Condition')));
		$this->Transaction->unbindModel(array('belongsTo' => array('User')));
		$facture = $this->Transaction->find('all', array('conditions' => array('Transaction.id' => $facture_id), 'recursive' => 2));
		if(empty($facture)){
			$this->redirect(array('controller' => 'transactions', 'action' => 'index'));
		}

		$this->set('facture', $facture);
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();
	}


	/**
	*	Permet de lister les factures
	*/
	public function admin_index(){
		$this->Transaction->unbindModel(array('hasMany' => array('Row'), 'hasAndBelongsToMany' => array('Typereglement')));
		$this->Transaction->recursive = 2;
		$this->set('list', $this->Transaction->find('all', array('conditions' => array('completed' => 1))));
	}


	/**
	*	Visualisation d'une facture
	*/
	public function admin_view($facture_id) {
		if(!is_numeric($facture_id) || is_numeric($facture_id) <= 0){
			$this->redirect(array('controller' => 'transactions', 'action' => 'index'));
		}

		$this->Transaction->Row->unbindModel(array('belongsTo' => array('Transaction', 'Book', 'Condition')));
		$this->Transaction->unbindModel(array('belongsTo' => array('User')));
		$facture = $this->Transaction->find('all', array('conditions' => array('Transaction.id' => $facture_id), 'recursive' => 2));
		if(empty($facture)){
			$this->redirect(array('controller' => 'transactions', 'action' => 'index'));
		}

		$this->set('facture', $facture);

	}

	/**
	*	Processus Vente
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
								 'total' => 0
								 );
					$this->Transaction->save($tmp);
					$this->Session->write('Transaction.achat.transaction_id', $this->Transaction->id);
					$this->Session->write('Transaction.achat.step', 2);
					$this->redirect($step_succ);

				}
			}
		}

		$listEnCours = $this->Transaction->find('all', array('conditions' => array(
																	'completed' => 0,
																	'type' => 'achat',
																	'user_id' => $this->Auth->user('id')
																	)
															));
		$this->set('listEnCours', $listEnCours);


	}

	/**
	*	Processus Vente
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
				$total = 0;
				foreach ($this->data as $key => $value) {
					$total += $value['Row']['prize_total'];
				}
				$this->Session->write('Transaction.achat.total', $total);
				$this->Transaction->id = $this->Session->read('Transaction.achat.transaction_id');
				$this->Transaction->save(array('total' => $total));


				$this->Session->write('Transaction.achat.step', 3);
			$this->redirect($step_succ);
			$listAchat = $this->data;
		}else{
			$listAchat = $this->Transaction->Row->find('all', array('conditions' => array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')),
																	'recursive' => -1));
			
		}

		$this->loadModel('Stock');
		foreach ($listAchat as $key => $value) {
			$listAchat[$key]['Row']['amount'] = intval($listAchat[$key]['Row']['amount']);
			
			$this->Stock->recursive = -1;
			$stock = $this->Stock->findAllByBookId($value['Row']['book_id']);

			$conditionList = array();
			foreach ($stock as $k => $v) {
				/* Calcul du max en fonction de si la ligne corresponds a une quantité déjà prise par le client*/
				if($value['Row']['condition_id'] == $v['Stock']['condition_id']){
					$max = $v['Stock']['depot']+$value['Row']['amount'] - $v['Stock']['vente'];
					$tmp = $this->Transaction->Row->Condition->findById($v['Stock']['condition_id']);
					$tmp['Condition']['max'] = $max;
					$conditionList[] = $tmp;
					$listAchat[$key]['Row']['Condition'] = $tmp;
				}else{
					$max = $v['Stock']['depot'] - $v['Stock']['vente'];
					/* si il reste des livres*/
					if($max > 0){
							$tmp = $this->Transaction->Row->Condition->findById($v['Stock']['condition_id']);
							$tmp['Condition']['max'] = $max;
							$conditionList[] = $tmp;
					}
				}
			}
			$listAchat[$key]['Row']['ConditionList'] = $conditionList;
		}
		$this->set('listAchat', $listAchat);
		$this->set('listFiliere', $this->Transaction->Row->Book->Subject->Grade->Sector->find('all'));

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
				if($key === 'Transaction'){
					foreach ($value as $k => $v) {
						if(isset($v['close']) && $v['close'] == 'on'){
							$this->request->data[$key][$k]['close'] =1;
						}else{
							unset($this->request->data[$key][$k]);
						}
					}
				}else{
					if(empty($value['amount'])){
						unset($this->request->data[$key]);
					}
				}
			}


			if(isset($this->data['Transaction']) && !empty($this->data['Transaction'])){
				$this->Session->write('Transaction.achat.oldTransaction', $this->data['Transaction']);
				if(!$this->Transaction->saveMany($this->data['Transaction'])){
					$this->Session->setFlash('Erreur','message', array('type' => 'danger'));
				}
			}

			unset($this->request->data['Transaction']);

			$this->Transaction->TransactionsTypereglement->deleteAll(array('transaction_id' => $this->Session->read('Transaction.achat.transaction_id')));
			if($this->Transaction->TransactionsTypereglement->saveMany($this->data)){
				$this->Session->write('Transaction.achat.step', 4);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur règlement','message', array('type' => 'danger'));
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

		$this->Transaction->recursive = -1;
		$oldTransaction = $this->Transaction->find('all', array('conditions' => array('client_id' => $this->Session->read('Transaction.achat.Client.id'),
																					  'close' => 0, 'Transaction.id <>' => $this->Session->read('Transaction.achat.transaction_id'))));
		$this->set('oldTransaction', $oldTransaction);



	}



	/**
	*	Processus Vente
	*	Etape: 4	
	*	Récapitulation des achats du parent
	*/
	public function recapSale(){
		$this->helpers[] = 'Facture';
		$step_pred =  array('controller' => 'transactions', 'action' => 'reglement');
		if(!$this->Session->check('Transaction.achat') || $this->Session->read('Transaction.achat.step') < 4){
			$this->redirect($step_pred);
		}
		
		$step_succ =  array('controller' => 'transactions', 'action' => 'end');
		$this->set('step_for_progress_bar', 4);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar',  $step_succ);

		$this->Transaction->Row->unbindModel(array('belongsTo' => array('Transaction', 'Book', 'Condition')));
		$this->Transaction->unbindModel(array('belongsTo' => array('User')));
		$facture = $this->Transaction->find('all', array('conditions' => array('Transaction.id' => $this->Session->read('Transaction.achat.transaction_id')), 'recursive' => 2));
		$this->set('facture', $facture);


	}

	/**
	*	Processus Vente
	*	Etape: 5	
	*	Finalisation de la vente
	*/
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
	public function init($clientID = null){

		$step_succ =  array('controller' => 'transactions', 'action' => 'depot');

		$this->set('step_for_progress_bar', 1);
		$this->set('pred_for_progress_bar', '#');
		$this->set('suiv_for_progress_bar', $step_succ);


		if(!$this->Session->check('Transaction.depot')){
			$this->Session->write('Transaction.depot.step', 1);
		}

		if(isset($clientID) && is_numeric($clientID)){
			if(!$this->Session->check('Transaction.depot.Client')){
				$this->Transaction->recursive = 2;
				$this->Transaction->unbindModel(array('hasMany' => array('Row'), 'hasAndBelongsToMany' => array('Typereglement')));

				$client = $this->Transaction->Client->findById($clientID);
				if($client){
					$this->Session->write('Transaction.depot.Client', $client['Client']);
					$this->Session->write('Transaction.depot.Town', $client['Town']);

					$tmp = array('client_id' => $client['Client']['id'],
								 'user_id' => $this->Auth->user('id'),
								 'date' => date('Y-m-d',time(null)),
								 'type' => 'depot',
								 'close' => 0,
								 'completed' => 0,
								 );
					$this->Transaction->save($tmp);
					$this->Session->write('Transaction.depot.transaction_id', $this->Transaction->id);
					$this->Session->write('Transaction.depot.step', 2);
					$this->redirect($step_succ);

				}
			}
		}

		$listEnCours = $this->Transaction->find('all', array('conditions' => array(
																	'completed' => 0,
																	'type' => 'depot',
																	'user_id' => $this->Auth->user('id')
																	)
															));
		$this->set('listEnCours', $listEnCours);


	}

	/**
	*	Procéssus Dépot
	*	Etape: 2		
	*	Etape du dépôt des livres
	*/
	public function depot($clientID = null){

		$step_pred = array('controller' => 'transactions', 'action' => 'init');


		if(!$this->Session->check('Transaction') || $this->Session->read('Transaction.depot.step') < 2){
			$this->redirect($step_pred);
		}

		$step_succ = array('controller' => 'transactions', 'action' => 'recapDepot');
		$this->set('step_for_progress_bar', 2);
		$this->set('pred_for_progress_bar', $step_pred);		
		$this->set('suiv_for_progress_bar', $step_succ);		

		if(!empty($this->data)){
			$this->Transaction->Row->deleteAll(array('transaction_id' => $this->Session->read('Transaction.depot.transaction_id')));
			if($this->Transaction->Row->saveMany($this->data)){

				$total = 0;
				foreach ($this->data as $key => $value) {
					$total += $value['Row']['prize_total'];
				}
				$this->Session->write('Transaction.depot.total', $total);
				$this->Transaction->id = $this->Session->read('Transaction.achat.transaction_id');
				$this->Transaction->save(array('total' => $total));


				$this->Session->write('Transaction.depot.step', 3);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
			$listAchat = $this->data;
		}else{
			$listAchat = $this->Transaction->Row->find('all', array('conditions' => array('transaction_id' => $this->Session->read('Transaction.depot.transaction_id')),
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
	*	Processus Dépôt
	*	Etape: 3
	*	Etape de la récapitulation
	*/
	public function recapDepot(){
		$step_pred = array('controller' => 'transactions', 'action' => 'depot');
		$step_succ = array('controller' => 'transactions', 'action' => 'endDepot');
		if(!$this->Session->check('Transaction.depot') || $this->Session->read('Transaction.depot.step') < 3){
			$this->redirect($step_pred);
		}
		
		$this->set('step_for_progress_bar', 3);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', '#');

		$this->Transaction->Row->unbindModel(array('belongsTo' => array('Transaction', 'Book', 'Condition')));
		$this->Transaction->unbindModel(array('belongsTo' => array('User')));
		$facture = $this->Transaction->find('all', array('conditions' => array('Transaction.id' => $this->Session->read('Transaction.depot.transaction_id')), 'recursive' => 2));
		$this->set('facture', $facture);

		if(!empty($this->data)){
			if($this->Transaction->save($this->data)){
				$this->Session->write('Transaction.depot.step', 4);
				$this->redirect($step_succ);
			}else{
				$this->Session->setFlash('Erreur','message', array('type' => 'alert'));
			}
		}

	}


	public function endDepot(){
		$step_pred = array('controller' => 'transactions', 'action' => 'recapDepot');
		$step_succ = array('#');

		if(!$this->Session->check('Transaction.depot') || $this->Session->read('Transaction.depot.step') < 4){
			$this->redirect($step_pred);
		}
		
		$this->set('step_for_progress_bar', 4);
		$this->set('pred_for_progress_bar', $step_pred);
		$this->set('suiv_for_progress_bar', '#');
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
		if($tmp['Transaction']['type'] === 'achat'){
			$ext = 'achat';
			$action = 'sale';
		}else{
			$ext = 'depot';
			$action = 'depot';
		}
		$this->Session->write('Transaction.'.$ext.'.Client', $tmp['Client']);
		$this->Session->write('Transaction.'.$ext.'.Town', $tmp['Client']['Town']);
		$this->Session->write('Transaction.'.$ext.'.transaction_id', $id);
		$this->Session->write('Transaction.'.$ext.'.step', 2);

		$this->redirect(array('controller'=> 'transactions', 'action' => $action));
		
	}


	/**
	*	Reinitialise le panier et met a jour le stock
	*/
	public function refresh(){

		if($this->Session->check('Transaction.achat')){
			if($this->Session->check('Transaction.achat.transaction_id')){
				$tmp = $this->Transaction->findById($this->Session->read('Transaction.achat.transaction_id'));
				if($tmp){
					if($tmp['Transaction']['completed'] == 0){
						$this->loadModel('Stock');
						$maj = array();
					 	foreach ($tmp['Row'] as $key => $value) {
					 		$this->Stock->recursive = -1;
					 		$ligneStock = $this->Stock->findByBookIdAndConditionId($value['book_id'], $value['condition_id']);
					 		$ligneStock['Stock']['vente'] -= $value['amount'];
					 		$maj[] = current($ligneStock);
					 	}
					 	if(!$this->Stock->saveMany($maj)){
							$this->Session->setFlash('Error lors de la mise a jour du stock','message', array('type' => 'warning'));
					 	}

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

	/**
	*	Ajoute des lignes lors de la sélection
	*/
	public function addRow(){

		$this->loadModel('Stock');
		$res = array();
		$error = array();
		if(!empty($this->data)){
			foreach ($this->data as $key => $row) {

				$row = current($row);

				$stock = $this->Stock->findAllByBookId($row['book_id']);

				$conditionList = array();
				$valid = true;
				foreach ($stock as $k => $v) {
					$max = $v['Stock']['depot'] - $v['Stock']['vente'];

					if($v['Stock']['condition_id'] == $row['condition_id']){
						// Si il reste un exemplaire on peut enregistrer la ligne
						if($max > 1){
							$this->Transaction->Row->create();
							if($this->Transaction->Row->save($row)){
								$row['id'] = $this->Transaction->Row->id; 

								//On met a jour le stock
								$v['Stock']['vente'] += 1;
								if(!$this->Stock->save($v)){
									$error[] =array('type' => 'Erreur lors de la mise a jour stock',
							   						 'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a pas pu être compté'); 
								}
							}else{
								$error[] =array('type' => 'Erreur lors de l\'ajout en base de donnée',
							    'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a pas pu être ajouté'); 
							}
						}else{
							// Sinon il ne reste pas de livre en stock, on met une erreur et on quitte la boucle
							$valid = false;
							$error[] =array('type' => 'Stock Insufisant',
											'message' => 'Le livre '. $row['name_book'].' n\'est plus disponible dans l\'état '.$row['name_condition']); 
							break;
						}
					}

					//si il reste des livres
					if($max > 0){
						$tmp = $this->Transaction->Row->Condition->findById($v['Stock']['condition_id']);
						$tmp['Condition']['max'] = $max;
						$conditionList[] = $tmp;

						// L'état courant
						if($v['Stock']['condition_id'] == $row['condition_id']){
							$row['Condition'] = $tmp;
						}
					}
				}

				//Si le livre a été ajouté en BDD
				if($valid){
					$row['ConditionList'] = $conditionList;
					$res[]['Row'] = $row;
				}
			}
		}

		$response = array('rows' => $res, 'errors' => $error);


		echo json_encode($response);

		$this->autoRender = false;
	}




	/**
	*	Modifie une ligne, vérifie si le stock le permet et le met a jour
	*/
	public function updateRow(){
		$this->autoRender = false;
		$this->loadModel('Stock');
		$res = array();
		$error = array();
		$row = $this->data;
		$conditionList = array();
		$valid = true;
		if(!empty($this->data)){
			$rowInDataBase = $this->Transaction->Row->findById($this->data['id']);
			if(!empty($rowInDataBase)){
				$this->Stock->recursive =  -1;
				$stockInDataBase = $this->Stock->findAllByBookId($this->data['book_id']);

				foreach ($stockInDataBase as $k => $v) {
					$max = $v['Stock']['depot'] - $v['Stock']['vente'];

					// L'ancien état = le nouveau = l'état courant de la boucle
					if($rowInDataBase['Row']['condition_id'] == $v['Stock']['condition_id'] &&
						$v['Stock']['condition_id'] == $row['condition_id']){

						$nouveauStock = $v['Stock']['vente'] - $rowInDataBase['Row']['amount'] + $row['amount'];
						if($v['Stock']['depot'] - $nouveauStock >= 0){
							$stockInDataBase[$k]['Stock']['vente'] = $nouveauStock;
							$v = $stockInDataBase[$k];

						}else{
							$valid = false;
							$row['amount'] = intval($rowInDataBase['Row']['amount']);
							$error[] =array('type' => 'Plus de stock',
						   					'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a plus cette quantité'); 																
						}
						$max = $v['Stock']['depot'] - $v['Stock']['vente'] + $row['amount'];

					}else if($v['Stock']['condition_id'] == $row['condition_id']){
						$nouveauStock = $v['Stock']['vente'] + $row['amount'];
						//Si des livres sont encore disponibles
						if($v['Stock']['depot'] - $nouveauStock >= 0){
							$stockInDataBase[$k]['Stock']['vente'] = $nouveauStock;
							$v = $stockInDataBase[$k];
						}else{
							$valid = false;
							$error[] =array('type' => 'Plus de stock',
						   					'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a plus cette quantité'); 																
						}

						$max = $v['Stock']['depot'] - $v['Stock']['vente'] + $row['amount'];					
					}else if($v['Stock']['condition_id'] == $rowInDataBase['Row']['condition_id']){
						$nouveauStock = $v['Stock']['vente'] - $rowInDataBase['Row']['amount'];

						//Si des livres sont encore disponibles
						if($v['Stock']['depot'] - $nouveauStock >= 0){
							$stockInDataBase[$k]['Stock']['vente'] = $nouveauStock;
							$v = $stockInDataBase[$k];
							
						}else{
							$valid = false;
							$error[] =array('type' => 'Plus de stock',
						   					'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a plus cette quantité'); 																
						}
					$max = $v['Stock']['depot'] - $v['Stock']['vente'] + $row['amount'];
					}



					//si il reste des livres
					if($max > 0){
						$tmp = $this->Transaction->Row->Condition->findById($v['Stock']['condition_id']);
						$tmp['Condition']['max'] = $max;
						$conditionList[] = $tmp;
						// L'état courant
						if($v['Stock']['condition_id'] == $row['condition_id']){
							$row['Condition'] = $tmp;
						}
					}
				}

				if($valid){
					if($this->Transaction->Row->save($this->data)){
						if(!$this->Stock->saveMany($stockInDataBase)){
							$error[] =array('type' => 'Erreur lors de la mise à jour du stock',
						   					'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a pas pu être mis à jour'); 									
						}

						//On met a jour le stock avec la nouvelle quantité
						if(!$this->Stock->save($v)){
							$error[] =array('type' => 'Erreur lors de la mise à jour du stock',
					    					'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a pas pu être mis à jour'); 									
						}
					}else{
						$error[] =array('type' => 'Erreur lors de l\'ajout en base de donnée',
					    				'message' => 'Le livre '. $row['name_book'].' dans l\'état '.$row['name_condition'].' n\'a pas pu être mise à jour'); 
					}
				}

				$row['ConditionList'] = $conditionList;
				$res[]['Row'] = $row;
			}else{
				$error[] = array('type' => 'Erreur de recherche de la ligne',
								 'message' => 'Tentative de modification d\'une ligne inexistante');
			}
		}else{
			$error[] = array('type' => 'Pas de valeur',
							 'message' => 'Aucune valeur envoyée au serveur');
		}

		$response = array('rows' => $res, 'errors' => $error);

		echo json_encode($response);
	}

	/**
	*	Supprime une ligne
	*/
	public function deleteRow($id){
		$this->autoRender = false;
		if($this->Transaction->Row->delete($id)){
			echo 1;
		}else{
			echo 0;
		}
	}


	public function getGrades($id){
		$this->autoRender = false;
		echo json_encode($this->Transaction->Row->Book->Subject->Grade->find('all', array('conditions' => array('sector_id' => $id), 'recursive' => -1)));
	}

	public function getBooks($id){
		$this->autoRender = false;
		$this->loadModel('Condition');
		$this->Transaction->Row->Book->bindModel(array('hasMany' => array('Stock' => array('conditions' => array('(Stock.depot - Stock.vente) >' => 0)))));

		$tmp = $this->Transaction->Row->Book->find('all', array('fields' => array('Book.id, Book.name, Book.prize, Subject.name'), 'conditions' => array('grade_id' => $id)));
		foreach ($tmp as $key => $value) {
			if(empty($value['Stock'])){
				unset($tmp[$key]);
			}else{

				$conditionList = array();
				foreach ($value['Stock'] as $k => $v) {
					$conditionList[] = $v['condition_id'];
				}
				$resCondition = $this->Condition->findAllById($conditionList);
				foreach ($resCondition as $k1 => $v1) {
					$resCondition[$k1]['Condition']['max'] = $v['depot'] - $v['vente'];
				}


				$tmp[$key]['ConditionList'] = $resCondition;
				unset($tmp[$key]['Stock']);
			}
		}
		echo json_encode($tmp);
	}

	public function getBooksDepot($id){
		$this->autoRender = false;
		echo json_encode($this->Transaction->Row->Book->find('all', array('fields' => array('Book.id, Book.name, Book.prize, Subject.name'), 'conditions' => array('grade_id' => $id))));
	}


}
?>