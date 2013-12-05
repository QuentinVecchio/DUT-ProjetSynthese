<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Subject', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Ajout d'une matière</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
															'label' => array('text' => 'Nom de la matière:', 'class' => 'col-sm-4 control-label'),
															'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
