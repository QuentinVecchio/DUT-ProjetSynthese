<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Subject', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Subject=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Ajout d'une matière</legend>	
			<div class="form-group classForm">
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																		'name' => 'name',
																		'style' => 'margin-left : 10px;',
																		'ng-model' => 'Subject.Subject.name',
																		'ng-pattern' =>'/^[a-zA-Zéèêàâùûç\- ]{3,}$/',
																		'label' => array('text' => 'Nom de la matière : '))); ?>															
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.name.$error.required">Saisir le nom de la matière.</span>
	        	<span class="control-label" ng-show="form.name.$error.pattern">Caractères incorrectes ou longueur insuffisante.</span>
	        </div>				
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																		'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
