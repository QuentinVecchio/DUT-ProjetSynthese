<div class="row">
	
	<div class="formulaire">
		<div class="col-md-6 col-md-offset-3">
			<?php 
			echo $this->Form->create('User');
			?>
				<fieldset>
					<legend>Connexion</legend>
					<?php 
						echo $this->Form->input('username', array('label' => 'Identifiant', 'div' => array('class' => 'form-group')));
						echo $this->Form->input('password', array('label' => 'Mot de passe', 'div' => array('class' => 'form-group')));
						echo $this->Form->button('Se connecter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));
					 ?>
				</fieldset>
			<?php
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>