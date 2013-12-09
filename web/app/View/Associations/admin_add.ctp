<div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Association', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Ajout d'une Association</legend>
			<div class="form-group">
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),'label' => array('text' => 'Nom :', 'class' => 'col-sm-4 control-label'),'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('address', array('placeholder' => 'Adresse','input' => array('class' => 'form-control'),'label' => array('text' => 'Adresse :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('phone', array('placeholder' => 'Téléphone','input' => array('class' => 'form-control'),'label' => array('text' => 'Numéro de Téléphone :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('mail', array('placeholder' => 'Adresse mail','input' => array('class' => 'form-control'),'label' => array('text' => 'Adresse Mail :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>	
	</div>
</div>