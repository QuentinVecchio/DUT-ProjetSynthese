<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">	
	<?php 
		echo $this->Form->create('Condition', array('class' => 'form-horizontal', 'role' => 'form'));
	?>
		<fieldset>
				<legend>Modification d'un état</legend>	
				<div class="form-group">
					<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																					'label' => array('text' => 'Nom', 'class' => 'col-sm-4 control-label'),
																					'div' => array('class' => 'col-sm-10')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reducing', array('placeholder' => 'Réduction','input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Réduction', 'class' => 'col-sm-4 control-label'),
																	'div' => array('class' => 'col-sm-10')));?>
				</div>
				<?php echo $this->Form->button('Editer', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
	<?php
		echo $this->Form->end();
	?>
	</div>
</div>