<?php 
class Subject extends AppModel{
	public $belongsTo = array('Grade');

	public $validate = array(
			'name' => array(
				'unique' => array(
						'rule' => array('isUniqueBy', 'grade_id'),
						'required' => true,
						'message' => 'Le nom de la matière doit être unique pour une classe donnée'
					),
				'correct' => array(
						'rule' => '/^[a-zA-Zéèêàâùûç\- ]{3,}$/i',
						'message' => 'Le nom de la matière doit uniquement contenir des lettres'
					)
				)
		);
}
 ?>