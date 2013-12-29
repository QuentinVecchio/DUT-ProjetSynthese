<?php $this->extend('corps_transaction') ?>
<section ng-app="app" ng-controller="Controller">
	<h1>Choix du parent:</h1>
	<div ng-init="urlSearch='<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'getClient')); ?>';
				  urlStep2='<?php echo $this->Html->Url(array('controller' => 'transactions', 'action' => 'depot')) ?>'">
		<label for="searchParent">Rechercher le parent:</label>
		<input type="text" name="search" ng-model="search" ng-change="refresh()">
	</div>
	<table ng-show="match" class="table table-bordered">
		<caption>
				<h4>Résultat de la recherche:</h4><br>
		</caption>
		<thead>
  		<tr>
        	<th class="thNom">Nom</th>
       	 	<th class="thAdresse">Adresse</th>
       	 	<th style="width : 115px">Réglages</th>
  		</tr>
		</thead>
	   	
	   	<tbody>
	      	<tr ng-repeat="c in Clients">
	        	<td >{{c.Client.name}} {{c.Client.lastname}}</td>
	        	<td >{{c.Client.houseNumber}} {{c.Client.street}} {{c.Town.name}}</td>
				<td><a href="{{urlStep2}}/{{c.Client.id}}" class="btn btn-primary">Selectionner</a></td>
	        </tr>
	    </tbody>
	</table>
	<div ng-show="!match"><p>Parent non trouvé</p></div>
</section>
 <?php 
$this->start('script');
  echo $this->Html->script('transactionChoixParent');
$this->end();

 ?>