<?php 
class StocksController extends AppController{

	public function admin_index(){
		
		$this->loadModel('Transaction');
		$stock = $this->Transaction->Row->find('all',array( 'fields' => array('Transaction.date', 'book_id',
																			  'Transaction.type', 'Row.name_condition',
																			  'condition_id','SUM(amount) AS amount',
																			  'prize_unit','SUM(prize_total) AS total'),
															'group' => array('Transaction.date','type', 'book_id','condition_id')
															));
		$this->set('stock', $stock);

	}

	/**
	*	Visualisation du stock de livres par état et par vendu/déposé
	*/
	public function index(){
		$this->loadModel('Book');
		$this->Book->bindModel(array('hasMany' => array('Stock')));
		$this->set('stock', $this->Book->find('all'));

	}

}
 ?>