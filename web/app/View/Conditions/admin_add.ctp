<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">	
	<?php 
		echo $this->Form->create('Condition', array('class' => 'form-horizontal', 'role' => 'form','name' => 'form'));
	?>
		<fieldset ng-init="Condition=<?php if(isset($this->data['Condition']))echo htmlspecialchars(json_encode($this->data['Condition']));?>">
				<legend>Ajout d'un état</legend>	
				<div class="form-group classForm">
					<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																					'ng-model' => 'Condition.name',
																					'style' => 'margin-left : 10px;',
																					'ng-minLength' =>2, 'ng-maxLength' =>15,
																					'name' => 'name',
																					'ng-pattern' => '/^[a-zA-Zéèêàâùûç]+$/i',
																					'label' => array('text' => 'Nom : ')));?>
			    </div>   
				<div ng-show="form.name.$dirty && form.name.$invalid" class="erreur has-error">
			        <span class="control-label" ng-show="form.name.$error.required">Saisir un nom de réduction</span>
			       	<span class="control-label" ng-show="form.name.$error.pattern">Caractères incorrectes.</span>
			       	<span class="control-label" ng-show="form.name.$error.minlength">Nom trop petit.</span>
	          		<span class="control-label" ng-show="form.name.$error.maxlength">Nom trop long.</span>
			    </div>
				
				<br>
				<div class="form-group classForm">
					<?php echo $this->Form->input('reducing', array('placeholder' => 'Réduction','ng-model' => 'reducing',
																	'min' => '0',
																	'max' => '100',
																	'name' => 'reducing',
																	'ng-model' => 'Condition.reducing',
																	'input' => array('class' => 'form-control'),
																	'style' => 'margin-left : 10px;',
																	'label' => array('text' => 'Réduction : ')));?>
				</div>
				<div ng-show="form.reducing.$dirty && form.reducing.$invalid" class="erreur has-error">
			        <span class="control-label" ng-show="form.reducing.$error.required">Saisir une réduction</span>
			       	<span class="control-label" ng-show="form.reducing.$error.min">Un pourcentage est au dessus de 0% !</span>
			       	<span class="control-label" ng-show="form.reducing.$error.max">Un pourcentage de réduction est en dessous de 100% !</span>
			    </div>																	
				
				<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
	<?php
		echo $this->Form->end();
	?>
	</div>
</div>