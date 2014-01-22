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
						'rule' => '/^[a-zA-Z0-9éèêàâùûç\- ]{3,}$/i',
						'message' => 'Le nom du livre doit uniquement contenir des lettres'
					)
				),
			'prize' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Un prix est toujours strictement positif',
				'required' => true),
			'ISBN' => array(
				'rule' =>'/^978[0-9]{10}$|^979[0-9]{10}$/',
				'message' => 'ISBN incorect',
				'required' => true)
		);
}
 ?>