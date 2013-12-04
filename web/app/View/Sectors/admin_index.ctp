<h1>Liste des filières</h1>

<?php 
	debug($listFiliere);
?>
<ul>
	<?php 
		foreach ($listFiliere as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Edition:' .$v['Sector']['name'],
													 array('controller' => 'sectors', 'action' => 'edit', $v['Sector']['id']));
			 ?>
		</li>
	
	<?php endforeach; ?>

	<?php 
		foreach ($listFiliere as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Suppression:' .$v['Sector']['name'],
													 array('controller' => 'sectors', 'action' => 'delete', $v['Sector']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?'));
			 ?>
		</li>
	
	<?php endforeach; ?>

</ul>

<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'sectors', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



