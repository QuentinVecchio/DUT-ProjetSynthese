<?php 
class User extends AppModel{

	public $validate = array();

	public function beforeSave($options = array()) {
		if(isset($this->data['User']['password']) && !empty($this->data['User']['password'])){
	    	$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		if(empty($this->data['User']['password'])){
			unset($this->data['User']['password']);
		}
	    return true;
	}
} ?>