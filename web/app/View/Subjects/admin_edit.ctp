<div class="formulaire row" style="width : 700px; margin:auto;" ng-app>
	<div class="span4 offset6" ng-controller="Controller">
		<?php
			echo $this->Form->create('Subject', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Subject=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Edition d'une matière</legend>	
			<div class="form-group">
				<?php echo $this->Form->input('grade_id', array('type' => 'text', 'name' => 'grade_id', 'ng-model' => 'Subject.Subject.grade_id', 'div' => array('style' => 'display:none;'))) ?>				
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																		'name' => 'name',
																		'ng-model' => 'Subject.Subject.name',
																		'ng-pattern' =>'/^[a-zA-Zéèêàâùûç\- ]{3,}$/',
																		'label' => array('text' => 'Nom de la matière', 'class' => 'col-sm-4 control-label'),
																		'div' => array('class' => 'col-sm-10'))); ?>															
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
	        	<div ng-show="form.name.$error.required">Saisir le nom de la matière</div>
	        	<div ng-show="form.name.$error.pattern">Caractères incorrectes ou longueur insuffisante</div>
	        </div>				
			<?php echo $this->Form->button('Editer', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																		'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
