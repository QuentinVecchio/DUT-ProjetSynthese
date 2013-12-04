<?php 
	echo $this->Form->create('Sector');
		echo $this->Form->input('name', array('label' =>'Le nom de la filière:'));

		echo $this->Form->button('Modifier', array('class' => 'btn btn-primary'));
	echo $this->Form->end();
 ?>