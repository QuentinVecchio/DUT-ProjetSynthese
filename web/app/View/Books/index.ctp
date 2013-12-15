<table class="table table-bordered">
	<caption>
			<h4>Liste des livres</h4>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th class="thISBN">ISBN</th>
       	 	<th class="thMatiere">Matière</th>
  		</tr>
		</thead>
   	<tbody>
   		<?php foreach ($listLivre as $k => $v):?>
      	<tr>
        	<td><?php echo $v['Book']['name']; ?></td>
        	<td><?php echo $v['Book']['ISBN']; ?></td>
        	<td><?php echo $v['Subject']['name'];?></td>
    	</tr>       
    <?php endforeach; ?>
  	</tbody>
</table>