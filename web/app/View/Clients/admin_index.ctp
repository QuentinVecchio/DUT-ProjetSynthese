<h1>Liste des parents</h1>

<?php 
	debug($listParent);
?>
<ul>
	<?php 
		foreach ($listParent as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Edition:' .$v['Client']['name'],
													 array('controller' => 'clients', 'action' => 'edit', $v['Client']['id']));
			 ?>
		</li>
	
	<?php endforeach; ?>

	<?php 
		foreach ($listParent as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Suppression:' .$v['Client']['name'],
													 array('controller' => 'clients', 'action' => 'delete', $v['Client']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?'));
			 ?>
		</li>
	
	<?php endforeach; ?>

</ul>


<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'clients', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



