<?php 
	echo $this->Form->create('Book');

		echo $this->Form->input('name', array('label' => 'Nom'));
		echo $this->Form->input('ISBN', array('label' => 'ISBN'));
		echo $this->Form->input('subject_id', array('label' => 'Matière'));

		echo $this->Form->button('Ajouter', array('class' => 'btn'));
	echo $this->Form->end();
 ?>