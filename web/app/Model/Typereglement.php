<?php 
class Typereglement extends AppModel{
	public $validate= array(
			'name' => array(
				'correct' => array(
						'rule' => 'notEmpty',
						'required' => true,
						'message' => 'Champs vide'
								),
				'unique' => array(
					'rule' => 'isUnique',
					'required' => true,
					'message' => 'Nom de réglement déjà utilisé'
					)
				)
		);
}
 ?>