<table class="table table-bordered">
	<caption>
			<h4>Liste des Parents</h4>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th class="thAdresse">Adresse</th>
       	 	<th class="thMail">Email</th>
       	 	<th class="thTelephone">Téléphone</th>
       	 	<th class="thAssoc">Association</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
<?php 
	foreach ($listParent as $k =>$v): ?>
	          	<tr>
	            	<td><?php echo $v['Client']['name'].' '.$v['Client']['lastname']; ?></td>
	            	<td><?php echo $v['Client']['houseNumber'].' '.$v['Client']['street']; 
	            			  echo (isset($v['Town']) && !empty($v['Town']))?' '.$v['Town']['name'].' '.$v['Town']['zip_code']:''; ?></td>
	            	<td><?php echo $v['Client']['email']; ?></td>
	            	<td><?php echo $v['Client']['phone']; ?></td>
	            	<td><?php echo $v['Association']['name']; ?></td>
	            	<td>
	            		<div class="btn-group">
						  	<button type="button" class="btn btn-primary">Actions</button>
						  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    							<span class="caret"></span>
    							<span class="sr-only">Toggle Dropdown</span>
  							</button>
						  	<ul class="dropdown-menu" role="menu">
						    	<li><?php echo $this->Html->Link(' Edition',
						    										array('controller' => 'clients', 'action' => 'edit', $v['Client']['id']),
						    										array('class' => 'glyphicon glyphicon-pencil')); ?>
						    	</li>
						    	<li><?php echo $this->Html->Link(' Suppression',
													 		array('controller' => 'clients', 'action' => 'delete', $v['Client']['id']),
													 		array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 				'class' => 'glyphicon glyphicon-remove')); ?></li>
						  	</ul>
						</div>
					</td>
	        	</tr>   
<?php endforeach; ?>
  	</tbody>
</table>


<?php 
	echo $this->Html->Link('Ajouter', array('controller' => 'clients', 'action' => 'add', 'admin' => false), array('class' => 'btn btn-primary'));
 ?>
<?php 
	echo $this->Html->Link('Imprimer', array('controller' => 'clients', 'action' => 'print'), array('class' => 'btn btn-primary', 'style' => 'margin-left : 20px;'));
?>
