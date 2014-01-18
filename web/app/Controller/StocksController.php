<?php 
class StocksController extends AppController{

	public function admin_index(){
		
		$conditions = array();
		if(!empty($this->data)){
			if(isset($this->data['Stock']['type']) && $this->data['Stock']['type'] == 'tous'){
				unset($this->request->data['Stock']['type']);
			}

			if(isset($this->data['Stock']['condition_id']) && $this->data['Stock']['condition_id'] == 'tous'){
				unset($this->request->data['Stock']['condition_id']);
			}

			if(isset($this->data['Stock']['amount >=']) && !is_numeric($this->data['Stock']['amount >=']) && $this->data['Stock']['amount >='] < 0){
				$this->request->data['Stock']['amount >='] = 0;
			}

			if(isset($this->data['Stock']['prize_total >=']) && !is_numeric($this->data['Stock']['prize_total >='])){
				$this->request->data['Stock']['prize_total >='] = 0;
			}

			$conditions = $this->data['Stock'];
		}
		$this->loadModel('Transaction');


		$listCondition = $this->Transaction->Row->Condition->find('list');
		$listCondition['tous'] = 'Tous';
		$this->set('listCondition', $listCondition);

		$stock = $this->Transaction->Row->find('all',array( 'fields' => array('Transaction.date', 'book_id',
																			  'Transaction.type', 'Row.name_condition',
																			  'condition_id','SUM(amount) AS amount',
																			  'Row.name_book',
																			  'prize_unit','SUM(prize_total) AS total'),
															'conditions' => $conditions,
															'group' => array('Transaction.date','type', 'book_id','condition_id')
															));
		$this->set('stock', $stock);



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
	}

	/**
	*	Visualisation du stock de livres par état et par vendu/déposé
	*/
	public function index(){
		$this->loadModel('Book');
		$this->Book->bindModel(array('hasMany' => array('Stock')));
		$this->set('stock', $this->Book->find('all', array('recursive' => 3)));

		$this->loadModel('Transaction');

	}

}
 ?>