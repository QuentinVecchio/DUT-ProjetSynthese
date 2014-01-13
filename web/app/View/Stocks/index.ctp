<table class="table table-bordered">
	<caption>
			<h4>Visualisation du stock</h4><br>
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
			<th>Médiocre</th>
			<th>Moyen</th>
			<th>Bon</th>
			<th>Médiocre</th>
			<th>Moyen</th>
			<th>Bon</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($stock as $k =>$v): ?>
		<tr>
			<td><?php echo $v['Subject']['name']; ?></td>
			<td><?php echo $v['Book']['name']; ?></td>
			<?php foreach ($v['Stock'] as $key => $value): ?>
					<td><?php echo $value['depot']; ?></td>
					<td><?php echo $value['vente']; ?></td>
			<?php endforeach; ?>

			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>		
