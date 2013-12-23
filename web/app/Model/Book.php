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
						'rule' => '/^[a-zA-Zéèêàâùûç]{3,}$/i',
						'message' => 'Le nom du livre doit uniquement contenir des lettres'
					)
				),
			'prize' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Un prix est toujours strictement positif',
				'required' => true)
		);


	public function isUniqueBy($options = array(), $value) {
		$key = array_keys($options);
		return !$this->find('count', array('conditions' => array($this->alias.'.'.current($key) => $options[current($key)],
															 	$this->alias.'.'.$value => $this->data[$this->alias][$value])));
	}

}
 ?>