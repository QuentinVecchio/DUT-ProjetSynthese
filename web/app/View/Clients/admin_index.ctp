<table class="table table-bordered">
	<caption>
			<h4>Liste des Parents</h4>
		</caption>
		<thead>
  		<tr>
        	<th>Nom</th>
       	 	<th>Adresse</th>
       	 	<th>Adresse mail</th>
       	 	<th>Téléphone</th>
       	 	<th>Association</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
<?php 
	foreach ($listParent as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo $v['Client']['name']; ?></td>
	            	<td><?php echo $v['Client']['address']; ?></td>
	            	<td><?php echo $v['Client']['mail']; ?></td>
	            	<td><?php echo $v['Client']['phone']; ?></td>
	            	<td><?php echo $v['Association']['name']; ?></td>
	            	<td>
	            		<div class="btn-group">
						  	<button type="button" class="btn btn-primary">Actions</button>
						  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    							<span class="caret"></span>
    							<span class="sr-only">Toggle Dropdown</span>
  							</button>
						  	<ul class="dropdown-menu" role="menu">
						    	<li><?php echo $this->Html->Link(' Edition',
						    										array('controller' => 'clients', 'action' => 'edit', $v['Client']['id']),
						    										array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>
						    	<li><?php echo $this->Html->Link(' Suppression',
													 		array('controller' => 'clients', 'action' => 'delete', $v['Client']['id']),
													 		array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 				'class' => 'glyphicon glyphicon-remove')); ?></li>
						  	</ul>
						</div>
					</td>
	        	</tr>   
<?php endforeach; ?>
  	</tbody>
</table>


<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'clients', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



