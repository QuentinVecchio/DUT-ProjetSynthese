<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'books', 'action' => 'index', 'admin' => true, $this->data['Book']['subject_id'])) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des livres</a>
<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php 
			echo $this->Form->create('Book', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Book=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Edition d'un livre</legend>
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																					'name' => 'name',
																					'style' => 'margin-left : 10px;',
																					'ng-model' => 'Book.Book.name',
																					'autocomplete' => 'off',
																					'ng-pattern' =>'/^[a-zA-Z0-9!?\'éèêëïöôùçà&\- ]{1,}$/',
																					'label' => array('text' => 'Nom : '))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.name.$error.required">Saisir un nom de livre</span>
	        	<span class="control-label" ng-show="form.name.$error.pattern">Caractères incorrectes ou longueur insuffisante</span>
	        </div>	
			
			<br>
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('prize', array('placeholder' => 'Prix','input' => array('class' => 'form-control'),
																					'name' => 'prize',
																					'style' => 'margin-left : 10px;',
																					'ng-model' => 'Book.Book.prize',
																					'min'=> '0',
																					'label' => array('text' => 'Prix : '))); ?>
			</div>
			<div ng-show="form.prize.$dirty && form.prize.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.prize.$error.required">Saisir un prix</span>
	        	<span class="control-label" ng-show="form.prize.$error.min">Prix positif !</span>
	        </div>

	        <br>				
			<div class="form-group classForm corpsForm">
				<?php echo $this->Form->input('ISBN', array('placeholder' => 'ISBN','input' => array('class' => 'form-control'),
																					'name' => 'ISBN',
																					'style' => 'margin-left : 10px;',
																					'ng-model' => 'Book.Book.ISBN',
																					'autocomplete' => 'off',
																					'ng-pattern' =>'/^978[0-9]{10}$|^979[0-9]{10}$/',
																					'label' => array('text' => 'ISBN : '))); ?>
			</div>
			<div ng-show="form.ISBN.$dirty && form.ISBN.$invalid" class="erreur has-error">
	        	<span class="control-label" ng-show="form.ISBN.$error.required">Saisir un ISBN</span>
	        	<span class="control-label" ng-show="form.ISBN.$error.pattern">ISBN incorrecte</span>
	        </div>	
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																		'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>