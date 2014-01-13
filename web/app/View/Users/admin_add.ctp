  <div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form', 'name' =>'form'));
		?>
		<fieldset ng-init="User='<?php if(isset($this->data['User']))echo htmlspecialchars(json_encode($this->data['User']));?>'">
			<legend>Ajout d'un utilisateur</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('username', array('placeholder' => 'Identifiant',
																	'name' => 'username',
																	'ng-model'=>'User.username', 'ng-minlength'=>'2', 'ng-maxlength'=> '15',
																	'ng-pattern'=>'/^[a-zA-Z0-9\-!?&_éèêëïöôùçà ]+$/',
																	'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Identifiant ', 'class' => 'col-sm-4 control-label'),
																	'div' => array('class' => 'col-sm-10'))); ?>
			<div ng-show="form.username.$dirty && form.username.$invalid" class="col-sm-10">
	        	<div ng-show="form.username.$error.required">Saisir un nom d'utilisateur.</div>
	        	<div ng-show="form.username.$error.minlength">Nom trop petit.(2 caractères)</div>
	        	<div ng-show="form.username.$error.maxlength">Nom trop long.(15 caractères max)</div>
	        	<div ng-show="form.username.$error.pattern">Caractères incorrectes.</div>
	        </div>																	
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password', array('placeholder' => 'Mot de passe',
																	'name' => 'password',
																	'ng-model'=>'User.password', 'ng-minlength'=>'5',
																	'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Mot de passe ', 'class' => 'col-sm-4 control-label'), 
																	'div' => array('class' => 'col-sm-10'))); ?>
				<div ng-show="form.password.$dirty && form.password.$invalid" class="col-sm-10">
			        <div ng-show="form.password.$error.required">Saisir un mot de passe.</div>
			        <div ng-show="form.password.$error.minlength">Trop petit (5 caractères)</div>
		        </div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->input('password2', array('type' => 'password', 'input' => array('class' => 'form-control'),
																'name' => 'password2',
																'ng-model' => 'User.password2',
																'placeholder' => 'Confirmation',
																'match' => 'User.password',
																'label' => array('text' => 'Confirmation ', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			    <div ng-show="form.password2.$error.mismatch" class="col-sm-10">
			        <div>Les mots de passes ne correspondent pas !</div>
		        </div>
			</div>						


			<div class="form-group">
				<?php echo $this->Form->radio('status', array('operateur' => 'operateur', 'admin' => 'administrateur'),
														array('legend' => false, 'value' => 'operateur', 'name' => 'status'));?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success',
															'style' => 'border-radius: 0px;',
															'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
