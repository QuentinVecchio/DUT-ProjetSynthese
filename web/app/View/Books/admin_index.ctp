<table class="table table-bordered">
	<caption>
			<h4>Liste des livres</h4>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th class="thISBN">ISBN</th>
       	 	<th class="thMatiere">Matière</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
   		<?php foreach ($listLivre as $k => $v):?>
      	<tr>
        	<td><?php echo $v['Book']['name'] ?></td>
        	<td><?php echo $v['Book']['ISBN'] ?></td>
        	<td>test</td>
        	<td>
        		<div class="btn-group">
				  	<button type="button" class="btn btn-primary">Actions</button>
				  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
						</button>
				  	<ul class="dropdown-menu" role="menu">
				    	<li><a href="#" class="glyphicon glyphicon-pencil">Edition</a></li>
				    	<li><a href="#" class="glyphicon glyphicon-remove">Suppression</a></li>
				  	</ul>
				</div>
			</td>
    	</tr>       
    <?php endforeach; ?>
  	</tbody>
</table>
<?php 
  echo $this->Html->Link('Ajouter', array('controller' => 'books', 'action' => 'add', $idSubject), array('class' => 'btn btn-primary'));
 ?>

