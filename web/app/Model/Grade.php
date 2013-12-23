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


	public function isUniqueBy($options = array(), $value) {
		$key = array_keys($options);
		return !$this->find('count', array('conditions' => array($this->alias.'.'.current($key) => $options[current($key)],
															 	$this->alias.'.'.$value => $this->data[$this->alias][$value])));
	}
}
 ?>