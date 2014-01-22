<table class="table table-bordered">
	<caption>
			<h4>Liste des états</h4><br>
		</caption>
		<thead>
  		<tr>
          	<th class="thNom">Nom</th>
        	<th class="thNom">Réduction</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
   		<?php foreach ($listEtat as $k => $v):?>
      	<tr>
          <td><?php echo $v['Condition']['name'] ?></td>
        	<td><?php echo $v['Condition']['reducing'] ?></td>
        	<td>
        		<div class="btn-group">
				  	<button type="button" class="btn btn-primary">Actions</button>
				  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
						</button>
				  	<ul class="dropdown-menu" role="menu">
			            <li>
			            <?php 
			                echo $this->Html->Link(' Edition',array('controller' => 'conditions', 'action' => 'edit', $v['Condition']['id']),
			                                array('class' => 'glyphicon glyphicon-pencil'));
			            ?>               
			            </li>
				    	<li>
							<?php 
									/*echo $this->Html->Link(' Suppression',
													 array('controller' => 'conditions', 'action' => 'delete', $v['Condition']['id']),
													 array(	'confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
													 		'class' => 'glyphicon glyphicon-remove'));*/
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
  //echo $this->Html->Link('Ajouter', array('controller' => 'conditions', 'action' => 'add'), array('class' => 'btn btn-primary'));
?>
<?php 
  echo $this->Html->Link('Imprimer', array('controller' => 'conditions', 'action' => 'print'), array('class' => 'btn btn-primary', 'style' => 'margin-left : 20px;'));
?>

