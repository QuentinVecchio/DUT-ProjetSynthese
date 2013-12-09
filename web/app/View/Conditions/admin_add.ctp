<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">	
	<?php 
		echo $this->Form->create('Condition', array('class' => 'form-horizontal', 'role' => 'form'));
	?>
		<fieldset>
				<legend>Ajout d'une Condition</legend>	
				<div class="form-group">
					<?php echo echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),'label' => array('text' => 'Nom :', 'class' => 'col-sm-4 control-label'),'div' => array('class' => 'col-sm-10')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reducing', , array('placeholder' => 'Réduction','input' => array('class' => 'form-control'),'label' => array('text' => 'Réduction :', 'class' => 'col-sm-4 control-label'),'div' => array('class' => 'col-sm-10')));?>
				</div>
				<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-primary'));?>
		</fieldset>
	<?php
		echo $this->Form->end();
	?>
	</div>
</div>