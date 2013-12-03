<?php 
echo $this->Form->create('User'); 
	echo $this->Form->input('username', array('Identifiant', 'div' => array('class' => 'form-group')));
	echo $this->Form->input('password', array('Mot de passe', 'div' => array('class' => 'form-group')));

	echo $this->Form->button('Se connecter', array('class' => 'btn btn-default'));
echo $this->Form->end();
?>
