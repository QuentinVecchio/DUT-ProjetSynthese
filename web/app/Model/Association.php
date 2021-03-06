<?php
class Association extends AppModel{
	public $belongsTo = array('Town');

	public $validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Veuillez renseigner un nom !'),
			'houseNumber' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Veuillez renseigner un numéro de rue!'),
			'street' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Veuillez renseigner une rue!'),
			'town_id' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Veuillez renseigner une ville!'),			
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Veuillez renseigner une adresse mail!'),	
			'phone' => array(
				'rule' => '/^0[1-9][0-9]{8}$|^[+]33[1-9][0-9]{8}$|^[+]352[0-9]{6,}$|^00352[0-9]{6,}$/',
				'required' => true,
				'message' => 'Veuillez renseigner un numéro de téléphone!'),	
		);
}
?>