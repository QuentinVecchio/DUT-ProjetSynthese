<?php 
	echo $this->Form->create('User');
		echo $this->Form->input('username', array('label' => 'Identifiant:'));
		echo $this->Form->input('password', array('label' => 'Mot de passe:'));
		echo $this->Form->button('Mettre à jour', array('class' => 'btn btn-primary'));
	echo $this->Form->end();
 ?>