<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Association', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="urlTown='<?php echo $this->Html->url(array('controller' => 'towns', 'action' => 'getTown')) ?>'">
			<legend ng-init="Associations=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">Edition d'une association</legend>
			<div class="form-group" >
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																'name' =>'name',
																'ng-minLength' =>2, 'ng-maxLength' =>15,
																'ng-pattern' =>' /^[a-zA-Z\. ]{1,}$/',
																'ng-model' => 'Associations.Association.name',
																'label' => array('text' => 'Nom', 'class' => 'col-sm-4 control-label'),
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
	          <div ng-show="form.name.$error.required">Saisir votre nom.</div>
	          <div ng-show="form.name.$error.minlength">Nom trop petit.</div>
	          <div ng-show="form.name.$error.maxlength">Nom trop long.</div>
	          <div ng-show="form.name.$error.pattern">Caractere incorrecte.</div>
	        </div>



			<div class="form-group">
				<?php echo $this->Form->input('houseNumber', array('placeholder' => 'N° rue','input' => array('class' => 'form-control'),
																'name' =>'houseNumber',
																'ng-model' => 'Associations.Association.houseNumber',
																'ng-pattern' => '/^[0-9]{1,3}$|^[0-9]{1,3} bis|ter$/',
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
																'ng-model' => 'Associations.Association.street',
																'label' => array('text' => 'Rue:', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>			
			<div class="form-group">
				<?php echo $this->Form->input('zip_code', array('ng-model' => 'Associations.Association.zip_code',
																'placeholder' => 'Code postal',
																'name' => 'zip_code',
																'ng-change' => 'traitement()',
																'label' => array('text' => 'Code postal:', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>

			<div class="form-group" ng-show="existe">
				<div class="col-sm-10">
					<label for="ville"  class="col-sm-4 control-label">Ville</label>
					<select class="form-control" style="width:164px; margin-left:304px;" ng-model="Associations.Association.town_id" name="town_id" ng-options="value.Town.name for value in villes track by value.Town.id" required></select>
				</div>
			</div>
			<span class="col-sm-10" ng-show="existePas">Aucune ville trouvée</span>
				
			<div class="form-group">
				<?php echo $this->Form->input('phone', array('placeholder' => 'Téléphone','input' => array('class' => 'form-control'),
																'name' => 'phone',
																'ng-model' => 'Associations.Association.phone',
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
																'ng-model' => 'Associations.Association.email',					
																'label' => array('text' => 'Adresse Mail', 'class' => 'col-sm-4 control-label'), 
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.email.$dirty && form.email.$invalid" class="col-sm-10">
	          <div ng-show="form.email.$error.required">Saisir une adresse mail</div>
	          <div ng-show="form.email.$error.email">Adresse mail incorrecte</div>
	        </div>


			<?php echo $this->Form->button('Editer', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;','ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>	
	</div>
</div>