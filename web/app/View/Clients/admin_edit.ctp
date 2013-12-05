 <div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('Client', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Ajout d'un Client</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('name', array('input' => array('class' => 'form-control'),'label' => array('text' => 'Nom :', 'class' => 'col-sm-4 control-label'),'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('address', array('input' => array('class' => 'form-control'),'label' => array('text' => 'Adresse :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('phone', array('input' => array('class' => 'form-control'),'label' => array('text' => 'Numéro de Téléphone :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('mail', array('input' => array('class' => 'form-control'),'label' => array('text' => 'Adresse Mail :', 'class' => 'col-sm-4 control-label'), 'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('association_id', 'Association :', array('class' => 'col-sm-4 control-label', 'style' => 'margin-left : -35px;')); ?>
				<?php echo $this->Form->select('association_id', $listAssoc, array('class' => 'form-control', 'style' => 'width : 200px; margin-left: 320px;')); ?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
