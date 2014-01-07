<div class="formulaire row" style="width : 700px; margin:auto;" ng-app="app">
	<div class="span4 offset6" ng-controller="Controller">
		<?php 
			echo $this->Form->create('Book', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'form'));
		?>
		<fieldset ng-init="Book=<?php if(isset($this->data))echo htmlspecialchars(json_encode($this->data));?>">
			<legend>Edition d'un livre</legend>
			<div class="form-group">
				<?php echo $this->Form->input('subject_id', array('type' => 'text',
																				'name' => 'subject_id',
																				'ng-model' => 'Book.Book.subject_id',
																				'div' => array('style' => 'display:none;'))); ?>					
				<?php echo $this->Form->input('name', array('placeholder' => 'Nom','input' => array('class' => 'form-control'),
																					'name' => 'name',
																					'ng-model' => 'Book.Book.name',
																					'ng-pattern' =>'/^[a-zA-Zéèêàâùûç\- ]{3,}$/',
																					'label' => array('text' => 'Nom', 'class' => 'col-sm-4 control-label'),
																					'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.name.$dirty && form.name.$invalid" class="col-sm-10">
	        	<div ng-show="form.name.$error.required">Saisir un nom de livre</div>
	        	<div ng-show="form.name.$error.pattern">Caractères incorrectes ou longueur insuffisante</div>
	        </div>	

			<div class="form-group">
				<?php echo $this->Form->input('prize', array('placeholder' => 'Prix','input' => array('class' => 'form-control'),
																					'name' => 'prize',
																					'ng-model' => 'Book.Book.prize',
																					'min'=> '0',
																					'label' => array('text' => 'Prix', 'class' => 'col-sm-4 control-label'), 
																					'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.prize.$dirty && form.prize.$invalid" class="col-sm-10">
	        	<div ng-show="form.prize.$error.required">Saisir un prix</div>
	        	<div ng-show="form.prize.$error.min">Prix positif !</div>
	        </div>				
			<div class="form-group">
				<?php echo $this->Form->input('ISBN', array('placeholder' => 'ISBN','input' => array('class' => 'form-control'),
																					'name' => 'ISBN',
																					'ng-model' => 'Book.Book.ISBN',
																					'ng-pattern' =>'/^978[0-9]{10}$|^979[0-9]{10}$/',
																					'label' => array('text' => 'ISBN', 'class' => 'col-sm-4 control-label'), 
																					'div' => array('class' => 'col-sm-10'))); ?>
			</div>
			<div ng-show="form.ISBN.$dirty && form.ISBN.$invalid" class="col-sm-10">
	        	<div ng-show="form.ISBN.$error.required">Saisir un ISBN</div>
	        	<div ng-show="form.ISBN.$error.pattern">ISBN incorrecte</div>
	        </div>	
			<?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
																		'ng-disabled' => 'form.$invalid')); ?>
		</fieldset>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>