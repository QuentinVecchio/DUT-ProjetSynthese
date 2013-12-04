<table class="table table-bordered">
	<caption>
			<h4>Liste des filières</h4>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>

       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
		<?php foreach ($listFiliere as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo $v['Sector']['name']; ?></td>
	            	<td>
	            		<div class="btn-group">
						  	<button type="button" class="btn btn-primary">Actions</button>
						  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    							<span class="caret"></span>
    							<span class="sr-only">Toggle Dropdown</span>
  							</button>
						  	<ul class="dropdown-menu" role="menu">
						    	<li><?php echo $this->Html->Link(' Edition', array('controller' => 'sectors', 'action' => 'edit', $v['Sector']['id']),
						    												array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>
						    	<li><?php echo $this->Html->Link(' Voir classes', array('controller' => 'grades', 'action' => 'index', $v['Sector']['id']),
						    												array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>						    	
						    	<li><?php echo $this->Html->Link(' Suppression',
													 array('controller' => 'sectors', 'action' => 'delete', $v['Sector']['id']),
													 array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 		'class' => 'glyphicon glyphicon-remove')); ?>
								</li>
						  	</ul>
						</div>
					</td>
	        	</tr>       
		<?php endforeach; ?>
	</tbody>
</table>
<?php 
	echo $this->Html->Link(' ', array('controller' => 'sectors', 'action' => 'add'), array('class' => 'btn btn-primary glyphicon glyphicon-plus'));
 ?>


