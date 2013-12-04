<?php 
	echo $this->Form->create('Condition');
		echo $this->Form->input('name', array('label' => 'Nom'));
		echo $this->Form->input('reducing', array('label' => 'Réduction'));

		echo $this->Form->button('Ajouter', array('class' => 'btn btn-primary'));
	echo $this->Form->end();
 ?>