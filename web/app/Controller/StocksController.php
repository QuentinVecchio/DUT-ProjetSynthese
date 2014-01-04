<?php 
class StocksController extends AppController{

	public function admin_index(){
		
		$this->loadModel('Transaction');
		$stock = $this->Transaction->Row->find('all',array( 'fields' => array('Transaction.date', 'book_id', 'condition_id','SUM(amount) AS amount'),
															'condition' =>array('type' => 'depot'),
															'group' => array('Transaction.date','book_id','condition_id')
															));
		$this->set('stock', $stock);
	}

}
 ?>