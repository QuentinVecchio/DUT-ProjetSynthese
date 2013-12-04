<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Association');
		?>
		<fieldset>
			<legend>Ajout d'une Association</legend>		
			<?php 
				echo $this->Form->input('name', array('label' => 'Nom ','div' => array('class' => 'form-group')));
				echo $this->Form->input('address', array('label' => 'L\'adresse ', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('phone', array('label' => 'Numéro de téléphone ', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('mail', array('label' => 'L\'adresse mail ', 'div' => array('class' => 'form-group')));
				echo $this->Form->button('Mettre à jour', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));
			?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>	
	</div>
</div>