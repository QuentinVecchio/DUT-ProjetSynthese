<?php 
class Client extends AppModel{
	public $belongsTo = array('Association', 'Town');
} ?>