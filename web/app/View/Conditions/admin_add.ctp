<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">	
	<?php 
		echo $this->Form->create('Condition', array('class' => 'form-horizontal', 'role' => 'form','name' => 'form'));
	?>
		<fieldset ng-init="Condition=<?php if(isset($this->data['Condition']))echo htmlspecialchars(json_encode($this->data['Condition']));?>">
				<legend>Ajout d'un état</legend>	
				<div class="form-group">
					<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																					'ng-model' => 'Condition.name',
																					'name' => 'name',
																					'ng-pattern' => '/^[a-zA-Zéèêàâùûç]{3,}$/i',
																					'label' => array('text' => 'Nom', 'class' => 'col-sm-4 control-label'),
																					'div' => array('class' => 'col-sm-10')));?>
			       
					<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
			        	<div ng-show="form.name.$error.required">Saisir un nom de réduction</div>
			        	<div ng-show="form.name.$error.pattern">Caractères incorrectes.</div>
			        </div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reducing', array('placeholder' => 'Réduction','ng-model' => 'reducing',
																	'min' => '0',
																	'max' => '100',
																	'name' => 'reducing',
																	'ng-model' => 'Condition.reducing',
																	'input' => array('class' => 'form-control'),
																	'label' => array('text' => 'Réduction', 'class' => 'col-sm-4 control-label'),
																	'div' => array('class' => 'col-sm-10')));?>
					<div ng-show="form.reducing.$dirty && form.reducing.$invalid" class="col-sm-10">
			        	<div ng-show="form.reducing.$error.required">Saisir une réduction</div>
			        	<div ng-show="form.reducing.$error.min">Un pourcentage est au dessus de 0% !</div>
			        	<div ng-show="form.reducing.$error.max">Un pourcentage de réduction est en dessous de 100% !</div>
			        </div>																	
				</div>
				<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
	<?php
		echo $this->Form->end();
	?>
	</div>
</div>