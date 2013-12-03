<div class="row">
	<div class="span4 offset6">
		<?php 
		echo $this->Form->create('User');
		?>
			<fieldset>
				<legend>Connexion</legend>
				<?php 
					echo $this->Form->input('username', array('Identifiant', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('password', array('Mot de passe', 'div' => array('class' => 'form-group')));
					echo $this->Form->button('Se connecter', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;'));
				 ?>
			</fieldset>
		<?php
		echo $this->Form->end();
		?>
	</div>
</div>