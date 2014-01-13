<table class="table table-bordered">
	<caption>
			<h4>Flux quotidiens</h4><br>
	</caption>
	<thead>
		<tr>
			<th>Date</th>
			<th>Type</th>
			<th>Livre</th>
			<th>Etat</th>
			<th>Quantité</th>
			<th>Prix</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($stock as $k =>$v): ?>
		<tr>
			<td><?php echo $v['Transaction']['date']; ?></td>
			<td><?php echo $v['Transaction']['type']; ?></td>
			<td><?php echo $v['Row']['name_book']; ?></td>
			<td><?php echo $v['Row']['name_condition']; ?></td>
			<td><?php echo $v[0]['amount']; ?></td>
			<td><?php echo $v[0]['total']; ?></td>
		
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>		
