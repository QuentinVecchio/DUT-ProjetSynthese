<h1>Liste des parents</h1>

<?php 
	debug($listParent);
?>
<!-- <ul>
	<?php 
		foreach ($listParent as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Edition:' .$v['Association']['name'],
													 array('controller' => 'associations', 'action' => 'edit', $v['Association']['id']));
			 ?>
		</li>
	
	<?php endforeach; ?>

	<?php 
		foreach ($listParent as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Suppression:' .$v['Association']['name'],
													 array('controller' => 'associations', 'action' => 'delete', $v['Association']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?'));
			 ?>
		</li>
	
	<?php endforeach; ?>

</ul>
-->
<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'clients', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



