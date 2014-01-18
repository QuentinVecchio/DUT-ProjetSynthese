<section>
	<?php $type =(isset($this->data['Transaction']['type']) && !empty($this->data['Transaction']['type'])) ? $this->data['Transaction']['type']: 'tous'; ?>
	<?php $user =(isset($this->data['Transaction']['user_id']) && !empty($this->data['Transaction']['user_id'])) ? $this->data['Transaction']['user_id']: 'tous'; ?>
	<?php echo $this->Form->create(); ?>
			<?php echo $this->Form->input('type', array('options' => array(
										    'depot'=>'Dépôt',
										    'achat'=>'Achat',
										    'tous' => 'Tous'
										 		),
											'label' => 'Les types de facture',
											'selected' => $type
										 		)); ?>
			<?php echo $this->Form->input('user_id', array('options' => array($listOperateur),
											'label' => 'Les opérateurs',
											'selected' => $user
										 		)); ?>

			<?php echo $this->Form->input('Client.name', array('label' => 'Le prénom du parent', 'required' => false)) ?>
			<?php echo $this->Form->input('Client.lastname', array('label' => 'Le nom du parent', 'required' => false)) ?>

	<?php echo $this->Form->end('Filtrer'); ?>


</section>
<table class="table table-bordered">
	<caption>
			<h4>Liste factures</h4><br>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Date</th>
        	<th class="thNom">Type</th>
        	<th class="thNom">Opérateur</th>
        	<th class="thNom">Nom</th>
        	<th class="thNom">Adresse</th>

       	 	<th style="width : 115px">Options</th>
  		</tr>
		</thead>
   	<tbody>
		<?php foreach ($list as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo date("d-m-Y", strtotime($v['Transaction']['date'])); ?></td>
	            	<td><?php echo $v['Transaction']['type']; ?></td>
	            	<td><?php echo $v['User']['username']; ?></td>
	            	
            		<?php if(isset($v['Client']) && !empty($v['Client']) && isset($v['Client']['Town']) && !empty($v['Client']['Town'])): ?>
            	
            			<td>
            				<?php echo $v['Client']['name'].' '.$v['Client']['lastname'];  ?>
            			</td>
            			<td>
            				<?php echo $v['Client']['houseNumber'].' '.$v['Client']['street'].' '.$v['Client']['Town']['name'] ?>
            			</td>
	            		 			
	            	<?php else: ?>
        				<td>Parent supprimé</td>
        				<td>Informations non displonibles</td>
	            	<?php endif; ?>
	            	<td>
	            		<?php echo $this->Html->Link('Visualiser', array('controller' => 'transactions', 'action' => 'view', $v['Transaction']['id']), array('class' => 'btn btn-primary')) ?>
					</td>
	        	</tr>       
		<?php endforeach; ?>
	</tbody>
</table>