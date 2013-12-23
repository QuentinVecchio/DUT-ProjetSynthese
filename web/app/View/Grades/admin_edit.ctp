<div class="formulaire row" style="width : 700px; margin:auto;" ng-app>
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Grade', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Grade=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Edition d'une classe</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('sector_id', array('type' => 'text', 'name' => 'sector_id', 'ng-model' => 'Grade.Grade.sector_id', 'div' => array('style' => 'display:none;'))) ?>
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																		'name' => 'name',
																		'ng-model' => 'Grade.Grade.name',
																		'ng-pattern' =>'/^[a-zA-Zéèêàâùûç]{1,}$/',
																		'label' => array('text' => 'Nom de la classe', 'class' => 'col-sm-4 control-label'),
																		'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
	        	<div ng-show="form.name.$error.required">Saisir un nom de classe</div>
	        	<div ng-show="form.name.$error.pattern">Caractères incorrectes.</div>
	        </div>				
			<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																		'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
