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
						'rule' => '/^[a-z]{3,}$/i',
						'message' => 'Le nom de la matière doit uniquement contenir des lettres'
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