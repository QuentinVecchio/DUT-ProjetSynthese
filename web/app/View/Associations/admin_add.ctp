<?php 
	echo $this->Form->create('Association');

		echo $this->Form->input('name', array('label' => 'Nom'));
		echo $this->Form->input('address', array('label' => 'L\'adresse'));
		echo $this->Form->input('phone', array('label' => 'Numéro de téléphone'));
		echo $this->Form->input('mail', array('label' => 'L\'adresse mail'));

		echo $this->Form->button('Ajouter', array('btn'));
	echo $this->Form->end();
 ?>