  <div class="formulaire row" style="width : 700px; margin:auto;" ng-app>
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form', 'name' =>'form'));
		?>
		<fieldset>
			<legend>Ajout d'un utilisateur</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('username', array('placeholder' => 'Identifiant',
																	'ng-model'=>'user.nom', 'ng-minlength'=>'2', 'ng-maxlength'=> '15',
																	'ng-pattern'=>'/^[a-zA-Z ]{1,}$/', 'name' => 'nom',
																	'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Identifiant ', 'class' => 'col-sm-4 control-label'),
																	'div' => array('class' => 'col-sm-10'))); ?>
			<div ng-show="form.nom.$dirty && form.nom.$invalid" class="col-sm-10">
	        	<div ng-show="form.nom.$error.required">Saisir un nom d'utilisateur.</div>
	        	<div ng-show="form.nom.$error.minlength">Nom trop petit.(2 caractères)</div>
	        	<div ng-show="form.nom.$error.maxlength">Nom trop long.(15 caractères max)</div>
	        	<div ng-show="form.nom.$error.pattern">Caractères incorrecte.</div>
	        </div>																	
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password', array('placeholder' => 'Mot de passe',
																	'ng-model'=>'user.password', 'ng-minlength'=>'5',
																	'name' => 'password',
																	'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Mot de passe ', 'class' => 'col-sm-4 control-label'), 
																	'div' => array('class' => 'col-sm-10'))); ?>
			<div ng-show="form.password.$dirty && form.password.$invalid" class="col-sm-10">
		        <div ng-show="form.password.$error.required">Saisir un mot de passe.</div>
		        <div ng-show="form.password.$error.minlength">Trop petit (5 caractères)</div>
	        </div>

			</div>
			<div class="form-group">
				<?php echo $this->Form->radio('status', array('operateur' => 'operateur', 'admin' => 'administrateur'),
														array('legend' => false, 'value' => 'operateur'));?>
			</div>
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
			'name' =>'submit', 'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
