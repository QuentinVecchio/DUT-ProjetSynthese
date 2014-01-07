<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Sector', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Sector=<?php if(isset($this->data['Sector']))echo htmlspecialchars(json_encode($this->data['Sector']));?>">
			<legend>Edition d'une filière</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('name', array('input' => array('class' => 'form-control'),
																'name' => 'name',
																'ng-model' => 'Sector.name',
																'ng-pattern' =>'/^[A-Z ]{1,}$/',
																'label' => array('text' => 'Nom de la filière', 'class' => 'col-sm-4 control-label'),
																'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
	        	<div ng-show="form.name.$error.required">Saisir un nom de filière</div>
	        	<div ng-show="form.name.$error.pattern">Caractères incorrectes.</div>
	        </div>					
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
															'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
