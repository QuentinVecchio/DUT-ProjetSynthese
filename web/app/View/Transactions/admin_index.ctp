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