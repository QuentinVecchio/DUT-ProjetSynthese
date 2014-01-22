<?php 
class Row extends AppModel{
	public $belongsTo = array('Book', 'Condition', 'Transaction');
}
 ?>