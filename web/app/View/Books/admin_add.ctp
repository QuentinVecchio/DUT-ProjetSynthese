 <div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php 
			echo $this->Form->create('Book');
		?>
		<fieldset>
			<legend>Ajout d'un livre</legend>
			<?php
				echo $this->Form->input('name', array('label' => 'Nom','div' => array('class' => 'form-group')));
				echo $this->Form->input('ISBN', array('label' => 'ISBN','div' => array('class' => 'form-group')));
				echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));
			?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>