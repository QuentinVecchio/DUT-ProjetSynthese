<?php 
	echo $this->Form->create('Client');
		echo $this->Form->input('name', array('label' => 'Nom:'));
		echo $this->Form->input('address', array('label' => 'Adresse:'));
		echo $this->Form->input('phone', array('label' => 'Téléphone:'));
		echo $this->Form->input('mail', array('label' => 'Adresse mail:'));

		echo $this->Form->label('association_id', 'Association:');
		echo $this->Form->select('association_id', $listAssoc);
		echo $this->Form->button('Ajouter', array('class' => 'btn btn-primary'));
	echo $this->Form->end();

 ?>