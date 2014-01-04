<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Client', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="urlTown='<?php echo $this->Html->url(array('controller' => 'towns', 'action' => 'getTown', 'admin' => false)) ?>'">
			<legend ng-init="Clients=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">Edition d'un parent</legend>	
		
			<div class="form-group" >
				<?php echo $this->Form->input('name', array('placeholder' => 'Prénom','input' => array('class' => 'form-control'),
																'name' =>'name',
																'ng-minLength' =>2, 'ng-maxLength' =>15,
																'ng-pattern' =>' /^[a-zA-Z\. ]{1,}$/',
																'ng-model' => 'Clients.Client.name',
																'autocomplete' => 'off',
																'label' => array('text' => 'Prénom:', 'class' => 'col-sm-4 control-label'),
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-12">
	          <div ng-show="form.name.$error.required">Saisir votre prénom.</div>
	          <div ng-show="form.name.$error.minlength">Prénom trop petit.</div>
	          <div ng-show="form.name.$error.maxlength">Prénom trop long.</div>
	          <div ng-show="form.name.$error.pattern">Caractere incorrecte.</div>
	        </div>
		
			<div class="form-group" >
				<?php echo $this->Form->input('lastname', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																'name' =>'lastname',
																'ng-minLength' =>2, 'ng-maxLength' =>15,
																'ng-pattern' =>' /^[a-zA-Z\. ]{1,}$/',
																'ng-model' => 'Clients.Client.lastname',
																'autocomplete' => 'off',
																'label' => array('text' => 'Nom:', 'class' => 'col-sm-4 control-label'),
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.lastname.$dirty && form.lastname.$invalid" class="col-sm-12">
	          <div ng-show="form.lastname.$error.required">Saisir votre nom.</div>
	          <div ng-show="form.lastname.$error.minlength">Nom trop petit.</div>
	          <div ng-show="form.lastname.$error.maxlength">Nom trop long.</div>
	          <div ng-show="form.lastname.$error.pattern">Caractere incorrecte.</div>
	        </div>


			<div class="form-group">
				<?php echo $this->Form->input('houseNumber', array('placeholder' => 'N° rue','input' => array('class' => 'form-control'),
																'name' =>'houseNumber',
																'ng-model' => 'Clients.Client.houseNumber',
																'ng-pattern' => '/^[0-9]{1,3}$|^[0-9]{1,3} bis|ter$/',
																'autocomplete' => 'off',
																'label' => array('text' => 'N° rue:', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.houseNumber.$dirty && form.houseNumber.$invalid" class="col-sm-10">
	          <div ng-show="form.houseNumber.$error.required">Saisir votre numero de rue.</div>
	          <div ng-show="form.houseNumber.$error.pattern">Numero de rue incorrecte.</div>
	        </div>


			<div class="form-group">
				<?php echo $this->Form->input('street', array('placeholder' => 'Rue','input' => array('class' => 'form-control'),
																'name' =>'street',
																'ng-model' => 'Clients.Client.street',
																'autocomplete' => 'off',
																'label' => array('text' => 'Rue:', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>			
			<div class="form-group">
				<?php echo $this->Form->input('zip_code', array('ng-model' => 'Clients.Town.zip_code',
																'placeholder' => 'Code postal',
																'name' => 'zip_code',
																'ng-change' => 'traitement2()',
																'autocomplete' => 'off',
																'label' => array('text' => 'Code postal:', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div class="form-group" ng-show="existe">
				<div class="col-sm-10">
					<label for="ville"  class="col-sm-4 control-label">Ville</label>
					<select class="form-control" style="width:164px; margin-left:304px;" ng-model="Clients.Client.town_id" ng-init="initTown2()" name="town_id" ng-options="value.Town.name for value in villes track by value.Town.id" ng-change="updateZipCode2()" required></select>
				</div>
			</div>
			<span class="col-sm-10" ng-show="existePas">Aucune ville trouvée</span>


			<div class="form-group">
				<?php echo $this->Form->input('phone', array('placeholder' => 'Téléphone','input' => array('class' => 'form-control'),
																'name' => 'phone',
																'ng-model' => 'Clients.Client.phone',
																'autocomplete' => 'off',
																'ng-pattern' => '/^0[1-9][0-9]{8}$|^[+]33[1-9][0-9]{8}$|^[+]352[0-9]{6,}$|^00352[0-9]{6,}$/',
																'label' => array('text' => 'Numéro de Téléphone', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.phone.$dirty && form.phone.$invalid" class="col-sm-10">
		        <div ng-show="form.phone.$error.required">Saisir votre numero de telephone.</div>
		        <div ng-show="form.phone.$error.pattern">Numero invalide.</div>
	        </div>

			<div class="form-group">
				<?php echo $this->Form->input('email', array('placeholder' => 'Adresse mail','input' => array('class' => 'form-control'),
																'name' => 'email',
																'ng-model' => 'Clients.Client.email',	
																'autocomplete' => 'off',				
																'label' => array('text' => 'Adresse Mail', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.email.$dirty && form.email.$invalid" class="col-sm-10">
	          <div ng-show="form.email.$error.required">Saisir une adresse mail</div>
	          <div ng-show="form.email.$error.email">Adresse mail incorrecte</div>
	        </div>

			<div class="form-group">
				<?php echo $this->Form->label('association_id', 'Association :', array('class' => 'col-sm-4 control-label', 'style' => 'margin-left : -35px;')); ?>
				<?php echo $this->Form->select('association_id', $listAssoc, array('class' => 'form-control', 'style' => 'width : 200px; margin-left: 320px;', 'name' => 'association_id')); ?>
			</div>
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;','ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
