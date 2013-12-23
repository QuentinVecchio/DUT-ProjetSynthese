<?php 
class Book extends AppModel{
	public $belongsTo = array('Subject');

	public $validate = array(
			'name' => array(
				'unique' => array(
						'rule' => array('isUniqueBy', 'subject_id'),
						'required' => true,
						'message' => 'Le nom du livre doit être unique pour une matière donnée'
					),
				'correct' => array(
						'rule' => '/^[a-zA-Zéèêàâùûç ]{3,}$/i',
						'message' => 'Le nom du livre doit uniquement contenir des lettres'
					)
				),
			'prize' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Un prix est toujours strictement positif',
				'required' => true)
		);
}
 ?>