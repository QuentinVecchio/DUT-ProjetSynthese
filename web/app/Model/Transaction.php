<?php 
class Transaction extends AppModel{
	public $belongsTo = array('Client','User');

	public $hasMany = array('Row');

	public $hasAndBelongsToMany =array('Typereglement');
}

 ?>