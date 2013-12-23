<table class="table table-bordered">
	<caption>
			<h4>Liste des Opérateurs</h4><br>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th class="thStatut">Statut</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
	<?php 
		foreach ($listUser as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo $v['User']['username']; ?></td>
	            	<td><?php echo $v['User']['status']; ?></td>
	            	<td>
	            		<div class="btn-group">
						  	<button type="button" class="btn btn-primary">Actions</button>
						  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    							<span class="caret"></span>
    							<span class="sr-only">Toggle Dropdown</span>
  							</button>
						  	<ul class="dropdown-menu" role="menu">
						    	<li><?php echo $this->Html->Link(' Edition',
													 array('controller' => 'users', 'action' => 'edit', $v['User']['id']),
													 array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	<li><?php echo $this->Html->Link(' Suppression',
													 array('controller' => 'users', 'action' => 'delete', $v['User']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 		'class' => 'glyphicon glyphicon-remove')); ?>
						  	</ul>
						</div>
					</td>
	        	</tr> 

	<?php endforeach; ?>
  	</tbody>
</table>

<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>