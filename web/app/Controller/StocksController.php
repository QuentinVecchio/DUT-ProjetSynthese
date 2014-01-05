<?php 
class StocksController extends AppController{

	public function admin_index(){
		
		$this->loadModel('Transaction');
		$stock = $this->Transaction->Row->find('all',array( 'fields' => array('Transaction.date', 'book_id',
																			  'Transaction.type', 'Condition.name',
																			  'condition_id','SUM(amount) AS amount',),
															'group' => array('Transaction.date','type', 'book_id','condition_id')
															));
		$this->set('stock', $stock);
	}

}
 ?>