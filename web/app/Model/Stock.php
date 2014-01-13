<?php 
class Stock extends AppModel{

	public $belongsTo = array('Book', 'Condition');
} ?>