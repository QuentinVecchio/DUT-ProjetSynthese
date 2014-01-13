<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'sectors', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des filières</a>
<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6"  ng-controller="Controller">
		<?php
			echo $this->Form->create('Sector', array('class' => 'form-horizontal', 'role' => 'form', 'name' =>'form'));
		?>
		<fieldset ng-init="Sector=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Ajout d'une Filière</legend>	
			<div class="form-group classForm">
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																'name' => 'name',
																'style' => 'margin-left : 10px;',
																'ng-model' => 'Sector.Sector.name',
																'ng-pattern' =>'/^[A-Z ]{1,}$/',
																'label' => array('text' => 'Nom de la filière : '))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="erreur has-error">
				<span class="control-label" ng-show="form.name.$error.required">Saisir un nom de filière</span>
		        <span class="control-label" ng-show="form.name.$error.pattern">Caractères incorrectes.</span>
	        </div>				
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
															'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>
