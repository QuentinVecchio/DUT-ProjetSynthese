<?php 
class User extends AppModel{

	public $validate = array(
			'username' => array(
				'rule' => 'isUnique',
				'message' => 'Nom déjà utilisé'),

			'passwordOld' => array(
					'rule' => 'checkCurrentPassWord',
					'message' => 'Mot de passe incorrect',
					'allowEmpty' => true
				),
			'password2' => array(
					'rule' => 'checkEqualPassWord',
					'message' => 'Les deux mots de passe sont différents',
					'allowEmpty' => true
				)			
			);

	public function beforeSave($options = array()) {
		if(isset($this->data['User']['password']) && !empty($this->data['User']['password'])){
	    	$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		if(empty($this->data['User']['password'])){
			unset($this->data['User']['password']);
		}
	    return true;
	}

	
	public function checkEqualPassWord($check) {
	    return $this->data['User']['password'] == $this->data['User']['password2'];
	}


	public function checkCurrentPassWord($check) {
			$this->id = $this->data['User']['id'];
			$password = $this->field('password');

	    return AuthComponent::password(current($check)) == $password;
	}

	public function afterValidate(){
		unset($this->data[$this->alias]['passwordOld']);
		unset($this->data[$this->alias]['password2']);
	}

} ?>