<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des opérateurs</a>
  <div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form', 'name' =>'form'));
		?>
		<fieldset ng-init="User='<?php if(isset($this->data['User']))echo htmlspecialchars(json_encode($this->data['User']));?>'">
			<legend>Ajout d'un utilisateur</legend>	
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('username', array('placeholder' => 'Identifiant',
																	'name' => 'username',
																	'ng-model'=>'User.username', 'ng-minlength'=>'2', 'ng-maxlength'=> '15',
																	'ng-pattern'=>'/^[a-zA-Z0-9\-!?&_éèêëïöôùçà ]+$/',
																	'input' => array('class' => 'form-control'),
																	'style' => 'margin-left : 10px;',
																	'label' => array('text' => 'Identifiant : '))); ?>
			</div>
			<div ng-show="form.username.$dirty && form.username.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.username.$error.required">Saisir un nom d'utilisateur.</span>
	        	<span class="control-label" ng-show="form.username.$error.minlength">Nom trop petit.(2 caractères)</span>
	        	<span class="control-label" ng-show="form.username.$error.maxlength">Nom trop long.(15 caractères max)</span>
	        	<span class="control-label" ng-show="form.username.$error.pattern">Caractères incorrectes.</span>
	        </div>

	        <br>																	
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('password', array('placeholder' => 'Mot de passe',
																	'name' => 'password',
																	'ng-model'=>'User.password', 'ng-minlength'=>'5',
																	'input' => array('class' => 'form-control'),
																	'style' => 'margin-left : 10px;',
																	'label' => array('text' => 'Mot de passe : '))); ?>
			</div>
			<div ng-show="form.password.$dirty && form.password.$invalid" class="erreur has-error">
			        <span class="control-label" ng-show="form.password.$error.required">Saisir un mot de passe.</span>
			        <span class="control-label" ng-show="form.password.$error.minlength">Trop petit (5 caractères)</span>   
			</div>

			<br>
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('password2', array('type' => 'password', 'input' => array('class' => 'form-control'),
																'name' => 'password2',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'User.password2',
																'placeholder' => 'Confirmation',
																'match' => 'User.password',
																'label' => array('text' => 'Confirmation : '))); ?>
			</div>
			<div ng-show="form.password2.$error.mismatch" class="erreur has-error">
			    <span class="control-label">Les mots de passes ne correspondent pas !</span>   
			</div>						

			<br>
			<div class="form-group classForm corpsForm">
				<div class="radio">
					<?php echo $this->Form->radio('status', array('operateur' => 'Opérateur'),
						array('legend' => false, 'value' => 'operateur', 'name' => 'status'));?>
				</div>
				<div class="radio">
					<?php echo $this->Form->radio('status', array('admin' => 'Administrateur'),
						array('legend' => false, 'value' => 'operateur', 'name' => 'status'));?>
				</div>								
			</div>
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success',
															'style' => 'border-radius: 0px;',
															'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
