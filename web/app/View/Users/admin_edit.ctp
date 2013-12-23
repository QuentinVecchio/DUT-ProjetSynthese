  <div class="formulaire row" style="width : 700px; margin:auto;" ng-app>
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form','name' => 'form'));
		?>
		<fieldset ng-init="User=<?php if(isset($this->data['User']))echo htmlspecialchars(json_encode($this->data['User']));?>">
			<legend>Edition d'un utilisateur</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('id', array('div' => array('style' => 'display:none;'), 'name' => 'id', 'ng-model' => 'id')); ?>
				<?php echo $this->Form->input('username', array('ng-model'=>'User.username', 'ng-minlength'=>2, 'ng-maxlength'=> '15',
																'name' => 'username',
																'ng-pattern'=>'/^[a-zA-Z ]{1,}$/',
																'input' => array('class' => 'form-control'),
																'label' => array('text' => 'Identifiant', 'class' => 'col-sm-5 control-label'),
																'div' => array('class' => 'col-sm-10'))); ?>
			<div ng-show="form.username.$dirty && form.username.$invalid" class="col-sm-10">
	        	<div ng-show="form.username.$error.required">Saisir un nom d'utilisateur.</div>
	        	<div ng-show="form.username.$error.minlength">Nom trop petit.(2 caractères)</div>
	        	<div ng-show="form.username.$error.maxlength">Nom trop long.(15 caractères max)</div>
	        	<div ng-show="form.username.$error.pattern">Caractères incorrecte.</div>
	        </div>																	
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('passwordOld', array('type' => 'password', 'input' => array('class' => 'form-control'),
																	'name' => 'passwordOld',
																	'ng-model' => 'passwordOld',
																	'label' => array('text' => 'Ancien mot de passe ', 'class' => 'col-sm-5 control-label'),
																	'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password', array('input' => array('class' => 'form-control'),
																	'name' => 'password',
																	'label' => array('text' => 'Nouveau mot de passe ', 'class' => 'col-sm-5 control-label'), 
																	'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password2', array('type' => 'password', 'input' => array('class' => 'form-control'),
																'name' => 'password2',
																'label' => array('text' => 'Confirmation ', 'class' => 'col-sm-5 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>						
			<div class="form-group">
				<?php echo $this->Form->radio('status', array('operateur' => 'operateur', 'admin' => 'administrateur'),
														 array('legend' => false, 'value' => $typeUtil, 'name' => 'status'));?>
			</div>
			<?php 
					if ($this->Form->isFieldError('status')) {
					    echo $this->Form->error('status');
					}
			 ?>

			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success',
															'style' => 'border-radius: 0px;','ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
