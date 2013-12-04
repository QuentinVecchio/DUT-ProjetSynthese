<?php 
	echo $this->Form->create('Grade');
		echo $this->Form->input('name', array('label' => 'Nom de la classe'));
		echo $this->Form->button('Ajouter', array('class' => 'btn btn-primary'));
	echo $this->Form->end();
 ?>