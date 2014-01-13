<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'sectors', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des filières</a>
<table class="table table-bordered">
	<caption>
			<h4>Liste des classes</h4><br>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
		<?php foreach ($listGrade as $k =>$v): ?>

      	<tr>
        	<td><?php echo $v['Grade']['name']; ?></td>
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
									echo $this->Html->Link(' Edition',array('controller' => 'grades', 'action' => 'edit', $v['Grade']['id']),
																	array('class' => 'glyphicon glyphicon-pencil'));
							 ?>				    		
				    	</li>
				    	<li>
							<?php 
									echo $this->Html->Link(' Voir matières',array('controller' => 'subjects', 'action' => 'index', $v['Grade']['id']),
																	array('class' => 'glyphicon glyphicon-pencil'));
							 ?>				    		
				    	</li>				    	
				    	<li>
							<?php 
									echo $this->Html->Link(' Suppression',
													 array('controller' => 'grades', 'action' => 'delete', $v['Grade']['id']),
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
	echo $this->Html->Link('Ajouter', array('controller' => 'grades', 'action' => 'add', $idGrade), array('class' => 'btn btn-primary'));
 ?>

<?php 
	echo $this->Html->Link('Imprimer', array('controller' => 'grades', 'action' => 'print', $idGrade), array('class' => 'btn btn-primary', 'style' => 'margin-left : 20px;'));
?>