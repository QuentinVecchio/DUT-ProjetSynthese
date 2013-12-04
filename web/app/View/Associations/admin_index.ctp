<table class="table table-bordered">
	<caption>
			<h4>Liste des Associations</h4>
		</caption>
		<thead>
  		<tr>
        	<th>Nom</th>
       	 	<th>Adresse</th>
       	 	<th>Adresse mail</th>
       	 	<th>Téléphone</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
		<?php foreach ($listAssoc as $k =>$v): ?>

      	<tr>
        	<td><?php echo $v['Association']['name']; ?></td>
        	<td><?php echo $v['Association']['address']; ?></td>
        	<td><?php echo $v['Association']['mail']; ?></td>
        	<td><?php echo $v['Association']['phone']; ?></td>
        	<td>
        		<div class="btn-group">
				  	<button type="button" class="btn btn-primary" >Actions</button>
				  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
						</button>
				  	<ul class="dropdown-menu" role="menu">
				    	<li>
							<?php 
									echo $this->Html->Link('Edition',array('controller' => 'associations', 'action' => 'edit', $v['Association']['id']),
																	array('class' => 'glyphicon glyphicon-pencil'));
							 ?>				    		
				    	</li>
				    	<li>
							<?php 
									echo $this->Html->Link('Suppression',
													 array('controller' => 'associations', 'action' => 'delete', $v['Association']['id']),
													 array(	'confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 		'class' => 'glyphicon glyphicon-remove'));
							 ?>				    		
				    	</li>				    	
				  	</ul>							
				</div>
			</td>
    	</tr>   
	
	<?php endforeach; ?>

  	</tbody>
</table>
<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'associations', 'action' => 'add'), array('class' => 'btn btn-primary'));
 ?>



