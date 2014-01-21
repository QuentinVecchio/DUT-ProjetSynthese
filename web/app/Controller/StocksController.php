<?php 
class StocksController extends AppController{

	public function admin_index(){
		
		$this->loadModel('Transaction');


		$listCondition = $this->Transaction->Row->Condition->find('list');
		$listCondition['tous'] = 'Tous';
		$this->set('listCondition', $listCondition);

		$stock = $this->Transaction->Row->find('all',array( 'fields' => array('Transaction.date', 'book_id',
																			  'Transaction.type', 'Row.name_condition',
																			  'condition_id','SUM(amount) AS amount',
																			  'Row.name_book',
																			  'prize_unit','SUM(prize_total) AS total'),
															'group' => array('Transaction.date','type', 'book_id','condition_id')
															));
		$this->set('stock_index', $stock);



	}

	/**
	*	Renouvellement manuel du stock par l'administrateur
	*/
	public function admin_edit(){

		if(!empty($this->data)){
			if($this->Stock->saveMany($this->data)){
				$this->Session->setFlash('Stock ok','message', array('type' => 'success'));
			}
		}

		$this->loadModel('Book');
		$this->Book->bindModel(array('hasMany' => array('Stock')));
		$stock_edit = $this->Book->find('all', array('recursive' => 3));

	foreach ($stock_edit as $k => $v) {
		foreach ($v['Stock'] as $key => $value) {
			$stock_edit[$k]['Stock'][$key]['vente'] = intval($stock_edit[$k]['Stock'][$key]['vente']);
			$stock_edit[$k]['Stock'][$key]['depot'] = intval($stock_edit[$k]['Stock'][$key]['depot']);
		}
		
	}
		$this->set('stock_edit', $stock_edit);

		$conditions = $this->Stock->Condition->find('all', array('fields' => 'Condition.name'));
		$this->set('etats', $conditions);
	}

	/**
	*	Visualisation du stock de livres par état et par vendu/déposé
	*/
	public function index(){
		$this->loadModel('Book');
		$this->Book->bindModel(array('hasMany' => array('Stock')));
		$this->set('stock', $this->Book->find('all', array('recursive' => 3)));

		$this->loadModel('Transaction');
		$conditions = $this->Stock->Condition->find('all', array('fields' => 'Condition.name'));
		$this->set('etats', $conditions);

	}

}
 ?>