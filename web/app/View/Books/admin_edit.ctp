 <div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php 
			echo $this->Form->create('Book', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Edition d'un livre</legend>
			<div class="form-group">
				<?php echo $this->Form->input('subject_id', array('type' => 'text',
																				'div' => array('style' => 'display:none;'))); ?>				
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																							'label' => array('text' => 'Nom', 'class' => 'col-sm-4 control-label'),
																							'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('prize', array('placeholder' => 'Prix','input' => array('class' => 'form-control'),
																							'label' => array('text' => 'Prix', 'class' => 'col-sm-4 control-label'), 
																							'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('ISBN', array('placeholder' => 'ISBN','input' => array('class' => 'form-control'),
																							'label' => array('text' => 'ISBN', 'class' => 'col-sm-4 control-label'), 
																							'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>