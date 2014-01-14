<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'users', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des opérateurs</a>
  <div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form','name' => 'form'));
		?>
		<fieldset ng-init="User=<?php if(isset($this->data['User']))echo htmlspecialchars(json_encode($this->data['User']));?>">
			<legend>Edition d'un utilisateur</legend>	
			<div class="form-group classForm">
				<?php echo $this->Form->input('id', array('div' => array('style' => 'display:none;'), 'name' => 'id', 'ng-model' => 'id')); ?>
				<?php echo $this->Form->input('username', array('ng-model'=>'User.username', 'ng-minlength'=>2, 'ng-maxlength'=> '15',
																'name' => 'username',
																'style' => 'margin-left : 10px;',
																'ng-pattern'=>'/^[a-zA-Z0-9\-!?&_éèêëïöôùçà ]+$/',
																'input' => array('class' => 'form-control'),
																'label' => array('text' => 'Identifiant : '))); ?>
			</div>
			<div ng-show="form.username.$dirty && form.username.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.username.$error.required">Saisir un nom d'utilisateur.</span>
	        	<span class="control-label" ng-show="form.username.$error.minlength">Nom trop petit.(2 caractères)</span>
	        	<span class="control-label" ng-show="form.username.$error.maxlength">Nom trop long.(15 caractères max)</span>
	        	<span class="control-label" ng-show="form.username.$error.pattern">Caractères incorrecte.</span>		
			</div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('passwordOld', array('type' => 'password', 'input' => array('class' => 'form-control'),
																	'name' => 'passwordOld',
																	'ng-model' => 'passwordOld',
																	'style' => 'margin-left : 10px;',
																	'placeholder' => 'Ancien mot de passe',
																	'required' => true,
																	'label' => array('text' => 'Ancien mot de passe : '))); ?>
			</div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('password', array('input' => array('class' => 'form-control'),
																	'name' => 'password',
																	'ng-model' => 'password',
																	'style' => 'margin-left : 10px;',
																	'placeholder' => 'Nouveau mot de passe',
																	'required' => true,
																	'label' => array('text' => 'Nouveau mot de passe : '))); ?>
			</div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('password2', array('type' => 'password', 'input' => array('class' => 'form-control'),
																'name' => 'password2',
																'ng-model' => 'password2',
																'placeholder' => 'Confirmation',
																'style' => 'margin-left : 10px;',
																'required' => true,
																'match' => 'password',
																'label' => array('text' => 'Confirmation : '))); ?>
			</div>

			<br>				
		    <div ng-show="form.password2.$error.mismatch" class="erreur has-error">
		        <span class="control-label">Les mots de passes ne correspondent pas !</span>
	        </div>
			
			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->radio('status', array('operateur' => ' Opérateur', 'admin' => ' Administrateur'),
														 array('legend' => false, 'value' => $typeUtil, 'name' => 'status', 'style' => 'margin-left: 10px;'));?>
			</div>
			<?php 
					if ($this->Form->isFieldError('status')) {
					    echo $this->Form->error('status');
					}
			 ?>

			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success',
															'style' => 'border-radius: 0px;','ng-disabled' => '(password||passwordOld||password2)&&(form.$invalid)', 'onClick' =>'(passwordOld.required=false)||(password.required=false)||(password2.required=false)')); ?>

		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
