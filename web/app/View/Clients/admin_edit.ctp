<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'clients', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des parents</a>
<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Client', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="urlTown='<?php echo $this->Html->url(array('controller' => 'towns', 'action' => 'getTown', 'admin' => false)) ?>'">
			<legend ng-init="Clients=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">Edition d'un parent</legend>	
		
			<div class="form-group classForm" >
				<?php echo $this->Form->input('name', array('placeholder' => 'Prénom','input' => array('class' => 'form-control'),
																'name' =>'name',
																'ng-minLength' =>2, 'ng-maxLength' =>15,
																'style' => 'margin-left : 10px;',
																'ng-pattern' =>'/^[a-zA-Zéèêàâùûç\- ]+$/i',
																'ng-model' => 'Clients.Client.name',
																'autocomplete' => 'off',
																'label' => array('text' => 'Prénom : '))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="erreur has-error">
	          <span class="control-label" ng-show="form.name.$error.required">Saisir votre prénom.</span>
	          <span class="control-label" ng-show="form.name.$error.minlength">Prénom trop petit.</span>
	          <span class="control-label" ng-show="form.name.$error.maxlength">Prénom trop long.</span>
	          <span class="control-label" ng-show="form.name.$error.pattern">Caractere incorrecte.</span>
	        </div>
		
			<br>		
			<div class="form-group classForm" >
				<?php echo $this->Form->input('lastname', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																'name' =>'lastname',
																'style' => 'margin-left : 10px;',
																'ng-minLength' =>2, 'ng-maxLength' =>15,
																'ng-pattern' =>'/^[a-zA-Zéèêàâùûç ]+$/i',
																'ng-model' => 'Clients.Client.lastname',
																'autocomplete' => 'off',
																'label' => array('text' => 'Nom : '))); ?>
			</div>
			<div ng-show="form.lastname.$dirty && form.lastname.$invalid" class="erreur has-error">
	          <span class="control-label" ng-show="form.lastname.$error.required">Saisir votre nom.</span>
	          <span class="control-label" ng-show="form.lastname.$error.minlength">Nom trop petit.</span>
	          <span class="control-label" ng-show="form.lastname.$error.maxlength">Nom trop long.</span>
	          <span class="control-label" ng-show="form.lastname.$error.pattern">Caractere incorrecte.</span>
	        </div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('houseNumber', array('placeholder' => 'N° rue','input' => array('class' => 'form-control'),
																'name' =>'houseNumber',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'Clients.Client.houseNumber',
																'ng-pattern' => '/^[0-9]{1,3}$|^[0-9]{1,3} bis|ter$/',
																'autocomplete' => 'off',
																'label' => array('text' => 'N° rue : '))); ?>
			</div>
			<div ng-show="form.houseNumber.$dirty && form.houseNumber.$invalid" class="erreur has-error">
	          <span class="control-label" ng-show="form.houseNumber.$error.required">Saisir votre numero de rue.</span>
	          <span class="control-label" ng-show="form.houseNumber.$error.pattern">Numero de rue incorrecte.</span>
	        </div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('street', array('placeholder' => 'Rue','input' => array('class' => 'form-control'),
																'name' =>'street',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'Clients.Client.street',
																'ng-pattern' => '/^[a-zA-Z-\'éèêëïöôùçà ]+$/',
																'autocomplete' => 'off',
																'label' => array('text' => 'Rue : '))); ?>
			</div>	
			<div ng-show="form.street.$dirty && form.street.$invalid" class="erreur has-error">
	          <span class="control-label" ng-show="form.street.$error.required">Saisir votre nom de rue.</span>
	          <span class="control-label" ng-show="form.street.$error.pattern">Nom de rue incorrecte.</span>
	        </div>
		
			<br>		
			<div class="form-group classForm">
				<?php echo $this->Form->input('zip_code', array('ng-model' => 'Associations.Town.zip_code',
																'placeholder' => 'Code postal',
																'name' => 'zip_code',
																'style' => 'margin-left : 10px;',
																'ng-change' => 'traitement()',
																'autocomplete' => 'off',
																'label' => array('text' => 'Code postal : '))); ?>
			</div>
			<div class="form-group" ng-show="existe">
				<div class="classForm">
					<label for="ville"  class="col-sm-4 control-label">Ville : </label>
					<select class="form-control input-sm" style="width:164px; margin-left:100px;" ng-model="Associations.Association.town_id" ng-init="initTown()" name="town_id" ng-options="value.Town.name for value in villes track by value.Town.id" ng-change="updateZipCode()" required></select>
				</div>
			</div>
			<div ng-show="form.email.$dirty && form.email.$invalid" class="erreur has-error">
	          	<span class="control-label" ng-show="existePas">Aucune ville trouvée</span>
	        </div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('phone', array('placeholder' => 'Téléphone','input' => array('class' => 'form-control'),
																'name' => 'phone',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'Clients.Client.phone',
																'autocomplete' => 'off',
																'ng-pattern' => '/^0[1-9][0-9]{8}$|^[+]33[1-9][0-9]{8}$|^[+]352[0-9]{6,}$|^00352[0-9]{6,}$/',
																'label' => array('text' => 'Numéro de Téléphone : '))); ?>
			</div>
			<div ng-show="form.phone.$dirty && form.phone.$invalid" class="erreur has-error">
		        <span class="control-label" ng-show="form.phone.$error.required">Saisir votre numero de telephone.</span>
		        <span class="control-label" ng-show="form.phone.$error.pattern">Numero invalide.</span>
	        </div>

			<br>
			<div class="form-group classForm">
				<?php echo $this->Form->input('email', array('placeholder' => 'Adresse mail','input' => array('class' => 'form-control'),
																'name' => 'email',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'Clients.Client.email',	
																'autocomplete' => 'off',				
																'label' => array('text' => 'Adresse Mail : '))); ?>
			</div>
			<div ng-show="form.email.$dirty && form.email.$invalid" class="erreur has-error">
	          <span class="control-label" ng-show="form.email.$error.required">Saisir une adresse mail</span>
	          <span class="control-label" ng-show="form.email.$error.email">Adresse mail incorrecte</span>
	        </div>

			<br>
			<div class="form-group classForm">
				<label for="association_id" class="col-sm-4 control-label" style="width : 150px;">Association : </label>
				<?php echo $this->Form->select('association_id', $listAssoc, array('class' => 'form-control input-sm', 'style' => 'width: 200px; margin-left: 10px;', 'name' => 'association_id')); ?>
			</div>
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;','ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
