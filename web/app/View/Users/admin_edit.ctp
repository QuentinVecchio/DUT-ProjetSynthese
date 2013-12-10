  <div class="formulaire row" style="width : 700px; margin:auto;">
	<div class="span4 offset6">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form'));
		?>
		<fieldset>
			<legend>Edition d'un utilisateur</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('id', array('div' => array('style' => 'display:none;'))); ?>
				<?php echo $this->Form->input('username', array('input' => array('class' => 'form-control'),'label' => array('text' => 'Identifiant :', 'class' => 'col-sm-5 control-label'),'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('passwordOld', array('type' => 'password', 'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Ancien mot de passe :', 'class' => 'col-sm-5 control-label'),
																	'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password', array('input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Nouveau mot de passe :', 'class' => 'col-sm-5 control-label'), 
																	'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password2', array('type' => 'password', 'input' => array('class' => 'form-control'),
																'label' => array('text' => 'Confirmation :', 'class' => 'col-sm-5 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>						
			<div class="form-group">
				<?php echo $this->Form->radio('status', array('operateur' => 'operateur', 'admin' => 'administrateur'),
														 array('legend' => false, 'value' => $typeUtil));?>
			</div>
			<?php 
					if ($this->Form->isFieldError('status')) {
					    echo $this->Form->error('status');
					}
			 ?>

			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
