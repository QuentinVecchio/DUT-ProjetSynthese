<?php 
class Condition extends AppModel{

	public $validate = array(
			'name' => array(
				'unique' => array(
						'rule' => array('isUnique'),
						'required' => true,
						'message' => 'Le nom de l\état doit être unique'
					),
				'correct' => array(
						'rule' => '/^[a-zA-Zéèêàâùûç]{3,}$/i',
						'message' => 'Le nom du livre doit uniquement contenir des lettres'
					)
				),
			'reducing' => array(
					'positif' => array(
							'rule' => array('comparison', '>=', 0),
							'message' => 'Un pourcentage de réduction est toujours entre 0 et 100',
							'required' => true
						),
					'inf100' => array(
							'rule' => array('comparison', '<=', 100),
							'message' => 'Un pourcentage de réduction est toujours entre 0 et 100',
							'required' => true
							)
						)
		);
}
 ?>