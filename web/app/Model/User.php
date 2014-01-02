<?php 
class User extends AppModel{

	public $validate = array(
			'username' => array(
				'unique' => array(
							'rule' => 'isUnique',
							'message' => 'Nom déjà utilisé'
							),
				'requis' => array(
					'rule' => array('minLength', 2),
					'on' => 'create',
					'required' => true,
					'message' => 'Nom requis (2 caractères minimum)')
				),
			'passwordOld' => array(
					'rule' => 'checkCurrentPassWord',
					'message' => 'Mot de passe incorrect',
					'allowEmpty' => true
				),
			'password' => array(
				'rule' =>  array('minLength', 5),
				'on' => 'create',
				'required' => true,
				'message' => 'mot de passe requis (5 caractères minimum'),
			'password2' => array(
					'rule' => 'checkEqualPassWord',
					'message' => 'Les deux mots de passe sont différents',
					'allowEmpty' => true
				),
			'status' => array(
					'on' =>'update',
					'rule' => 'notTheLastOne',
					'message' => 'C\'est le dernier des administrateurs, il ne peut pas être changé'
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

	public function notTheLastOne($check){
		if($check['status'] == 'operateur'){
			$tmp = $this->findAllByStatus('admin');
			if(count($tmp) == 1){
					if($this->data['User']['id'] == $tmp[0]['User']['id']){
						return false;
					}
			}
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

	public function beforeDelete($cascade = true) {
		$tmp = $this->findAllByStatus('admin');
		if(count($tmp) == 1){
				if($this->id == $tmp[0]['User']['id']){
					return false;
				}
		}
	  return true;
	}

} ?>