<ol class="breadcrumb">
  <li><a href="#"></a><?php echo $info['Grade']['Sector']['name']; ?></li>
  <li><a href="#"></a><?php echo $info['Grade']['name']; ?></li>
  <li><a href="#"></a><?php echo $info['Subject']['name']; ?></li>
</ol>

<a class="btn btn-primary btn-retour" href="<?php echo $this->Html->url( array('controller' => 'subjects', 'action' => 'index', 'admin' => true, $idMatiere)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
  Retourner à la liste des matières</a>
<table class="table table-bordered">
	<caption>
			<h4>Liste des livres</h4><br>
		</caption>
		<thead>
  		<tr>
          <th class="thNom">Nom</th>
        	<th class="thNom">Prix</th>
       	 	<th class="thISBN">ISBN</th>
       	 	<th class="thMatiere">Matière</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
   	<tbody>
   		<?php foreach ($listLivre as $k => $v):?>
      	<tr>
          <td><?php echo $v['Book']['name']; ?></td>
        	<td><?php echo $v['Book']['prize']; ?></td>
        	<td><?php echo $v['Book']['ISBN']; ?></td>
        	<td><?php echo $v['Subject']['name'];?></td>
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
                  echo $this->Html->Link(' Edition',array('controller' => 'books', 'action' => 'edit', $v['Book']['id']),
                                  array('class' => 'glyphicon glyphicon-pencil'));
               ?>               
              </li>
              <li>
              <?php 
                  echo $this->Html->Link(' Suppression',
                           array('controller' => 'books', 'action' => 'delete', $v['Book']['id']),
                           array( 'confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
                              'class' => 'glyphicon glyphicon-remove'));
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
  echo $this->Html->Link('Ajouter', array('controller' => 'books', 'action' => 'add', $idSubject), array('class' => 'btn btn-primary'));
?>
<?php 
  echo $this->Html->Link('Imprimer', array('controller' => 'books', 'action' => 'print'), array('class' => 'btn btn-primary', 'style' => 'margin-left : 20px;'));
?>
