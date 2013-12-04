<h1>Liste des états</h1>

<?php 
	debug($listEtat);
?>
<ul>
	<?php 
		foreach ($listEtat as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Edition:' .$v['Condition']['name'],
													 array('controller' => 'conditions', 'action' => 'edit', $v['Condition']['id']));
			 ?>
		</li>
	
	<?php endforeach; ?>

	<?php 
		foreach ($listEtat as $k =>$v): ?>
		<li>
			<?php 
					echo $this->Html->Link('Suppression:' .$v['Condition']['name'],
													 array('controller' => 'conditions', 'action' => 'delete', $v['Condition']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?'));
			 ?>
		</li>
	
	<?php endforeach; ?>

</ul>


<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'conditions', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



