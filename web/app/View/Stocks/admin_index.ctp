<section>
	<?php $type =(isset($this->data['Transaction']['type']) && !empty($this->data['Transaction']['type'])) ? $this->data['Transaction']['type']: 'tous'; ?>
	<?php $condition =(isset($this->data['Transaction']['condition_id']) && !empty($this->data['Transaction']['condition_id'])) ? $this->data['Transaction']['condition_id']: 'tous'; ?>
	<?php echo $this->Form->create(); ?>
			<?php echo $this->Form->input('type', array('options' => array(
										    'depot'=>'Dépôt',
										    'achat'=>'Achat',
										    'tous' => 'Tous'
										 		),
											'label' => 'Les types de facture',
											'selected' => $type
										 		)); ?>

			<?php echo $this->Form->input('condition_id', array('options' => array($listCondition),
											'label' => 'Les conditions',
											'selected' => $condition
										 		)); ?>

			<?php echo $this->Form->input('amount >=', array('label' => 'Quantité minimum')) ?>
			<?php echo $this->Form->input('prize_total >=', array('label' => 'Prix minimum')) ?>

	<?php echo $this->Form->end('Filtrer'); ?>


</section>
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
