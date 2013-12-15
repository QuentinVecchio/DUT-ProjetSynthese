<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Grade', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Edition d'une classe</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('name', array('input' => array('class' => 'form-control'),
																		'label' => array('text' => 'Nom de la classe', 'class' => 'col-sm-4 control-label'),
																		'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
