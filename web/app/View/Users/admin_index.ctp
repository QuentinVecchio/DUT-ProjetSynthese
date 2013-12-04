<h1>Listes des utilisateurs</h1>

<?php 
	debug($listUser);
 ?>
 <ul>
	<?php 
		foreach ($listUser as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Edition:' .$v['User']['username'],
													 array('controller' => 'users', 'action' => 'edit', $v['User']['id']));
			 ?>
		</li>
	
	<?php endforeach; ?>

	<?php 
		foreach ($listUser as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Suppression:' .$v['User']['username'],
													 array('controller' => 'users', 'action' => 'delete', $v['User']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?'));
			 ?>
		</li>
	
	<?php endforeach; ?>

</ul>

<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>