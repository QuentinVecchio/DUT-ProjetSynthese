<?php 
class Client extends AppModel{
	public $belongsTo = array('Association', 'Town');

	public $validate = array(
			'name' => array(
				'rule' => '/^[a-zA-Zéèêàâùûç ]{3,}$/i',
				'message' => 'Prénom incorrect'),
			'lastname' => array(
				'rule' => '/^[a-zA-Zéèêàâùûç ]{3,}$/i',
				'message' => 'Nom incorrect'),
			'email' => array(
				'rule' => 'notEmpty',
				'message' => 'Renseignez une adresse mail'),
			'phone' => array(
				'rule' => '/^0[1-9][0-9]{8}$|^[+]33[1-9][0-9]{8}$|^[+]352[0-9]{6,}$|^00352[0-9]{6,}$/',
				'message' => 'Numéro de téléphone incorrect'),
			'houseNumber' => array(
				'rule' => '/^[0-9]{1,3}$|^[0-9]{1,3} bis|ter$/',
				'message' => 'Numéro de rue incorrect')

		);
} ?>