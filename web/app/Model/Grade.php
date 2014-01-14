<?php 
class Grade extends AppModel{
	public $belongsTo = array('Sector');

	public $validate = array(
			'name' => array(
				'unique' => array(
						'rule' => array('isUniqueBy', 'sector_id'),
						'required' => true,
						'message' => 'Le nom de la classe doit être unique pour une filière donnée'
					),
				'correct' => array(
						'rule' => '/^[a-zA-Zéèêàâùûç]{3,}$/i',
						'message' => 'Le nom de la classe doit uniquement contenir des lettres'
					)
				)
		);
}
 ?>