<?php 
	echo $this->Form->create('Grade');
		echo $this->Form->input('name', array('label' => 'Nom de la classe'));
		echo $this->Form->input('sector_id', array('type' => 'text', 'div' => array('style' => 'display:none;')));
		echo $this->Form->button('Ajouter', array('class' => 'btn btn-primary'));

	echo $this->Form->end();
 ?>