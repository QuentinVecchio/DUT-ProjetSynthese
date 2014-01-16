<table class="table table-bordered">
	<caption>
			<h4>Visualisation du stock</h4><br>
			<strong>Par matière:&nbsp</strong>
			<?php 
				echo $this->Form->create();
					echo $this->Form->select('Subject.id', $listMatiere).'&nbsp';
				echo $this->Form->end(array('label'=>'Filtrer','div'=>false, 'class'=>'btn btn-primary'));
			 ?>
			<br>
	</caption>
	<thead>
		<tr>
			<th colspan="2">Livre</th>
			<th colspan="3">Dépôt</th>
			<th colspan="3">Vente</th>
		</tr>
		<tr>
			<th>Matière</th>
			<th>Nom</th>
			<th>Bon</th>
			<th>Moyen</th>
			<th>Médiocre</th>
			<th>Bon</th>
			<th>Moyen</th>
			<th>Médiocre</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($stock as $k =>$v): ?>
		<tr>
			<td><?php echo $v['Subject']['name']; ?></td>
			<td><?php echo $v['Book']['name']; ?></td>
			<td><?php echo $v['Stock'][0]['depot']; ?></td>
			<td><?php echo $v['Stock'][1]['depot']; ?></td>
			<td><?php echo $v['Stock'][2]['depot']; ?></td>
			<td><?php echo $v['Stock'][0]['vente']; ?></td>
			<td><?php echo $v['Stock'][1]['vente']; ?></td>
			<td><?php echo $v['Stock'][2]['vente']; ?></td>
			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>		
