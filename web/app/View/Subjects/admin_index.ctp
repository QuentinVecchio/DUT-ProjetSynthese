<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'grades', 'action' => 'index', 'admin' => true, $idSubject)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des classes</a>
<table class="table table-bordered">
	<caption>
			<h4>Liste des matières</h4><br>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>

       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
		<?php foreach ($listMatiere as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo $v['Subject']['name']; ?></td>
	            	<td>
	            		<div class="btn-group">
						  	<button type="button" class="btn btn-primary">Actions</button>
						  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    							<span class="caret"></span>
    							<span class="sr-only">Toggle Dropdown</span>
  							</button>
						  	<ul class="dropdown-menu" role="menu">
						    	<li><?php echo $this->Html->Link(' Edition', array('controller' => 'subjects', 'action' => 'edit', $v['Subject']['id']),
						    												array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>
						    	<li><?php echo $this->Html->Link(' Voir livres', array('controller' => 'books', 'action' => 'index', $v['Subject']['id']),
						    												array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>						    	
						    	<li><?php echo $this->Html->Link(' Suppression',
													 array('controller' => 'subjects', 'action' => 'delete', $v['Subject']['id']),
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
	echo $this->Html->Link('Ajouter', array('controller' => 'subjects', 'action' => 'add', $idSubject), array('class' => 'btn btn-primary'));
 ?>
