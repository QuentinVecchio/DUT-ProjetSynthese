 <div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Client');
		?>
		<fieldset>
			<legend>Ajout d'un Client</legend>	
			<?php 
				echo $this->Form->input('name', array('label' => 'Nom : ','div' => array('class' => 'form-group')));
				echo $this->Form->input('address', array('label' => 'Adresse : ','div' => array('class' => 'form-group')));
				echo $this->Form->input('phone', array('label' => 'Téléphone : ','div' => array('class' => 'form-group')));
				echo $this->Form->input('mail', array('label' => 'Adresse mail : ','div' => array('class' => 'form-group')));
				echo $this->Form->label('association_id', 'Association:');
				echo $this->Form->select('association_id', $listAssoc);
				echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));
			?>
			</fieldset>
			<?php
				echo $this->Form->end();
			?>
	</div>
</div>