<div ng-app="Stock" ng-controller="CtrlStockEdit">

<table class="table table-bordered" ng-init="stock=<?php echo htmlentities(json_encode($stock)) ?>">
	<caption>
			<h4>Visualisation du stock</h4><br>
			<div class="jumbotron" style="height:75px; width:1150px; margin-left:1px;">
				<div class="container" style="margin-left:-30px;">
					<label for="filiere" style="margin-right:16px; line-height:2;">Filiere:</label><input type="text" ng-model="filiere" id="filiere" style="width:150px; height:30px; line-height:1;">
					<label for="classe" style="margin-right:16px; margin-left:10px;">Classe:</label><input type="text" ng-model="classe" id="classe" style="width:150px; height:30px; line-height:1;">
					<label for="matiere" style="margin-right:16px; margin-left:10px;">Matière:</label><input type="text" ng-model="matiere" id="matiere" style="width:150px; height:30px; line-height:1;">
					<label for="livre" style="margin-right:16px; margin-left:10px;">Livre:</label><input type="text" ng-model="livre" id="livre" style="width:150px; height:30px; line-height:1;">
				</div>
    		</div><br>
    		<div class="jumbotron" style="height:40px; width:1150px; margin-left:1px;">
    			<div class="container" style="margin-top:-20px; margin-left:-40px;">
            		<strong>Astuce:</strong> il est possible de trier en fonction du champ en cliquant dessus
            	</div>
    		</div><br>
	</caption>
	<thead>
		<tr>
			<th colspan="4">Livre</th>
			<th colspan="3">Dépôt</th>
			<th colspan="3">Vente</th>
		</tr>
		<tr ng-init="reverse = true">
			<th ng-click="predicate='Subject.Grade.Sector.name';   reverse=!reverse   ">
				<span ng-show="predicate=='Subject.Grade.Sector.name' &&  reverse==true" class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
				<span ng-show="predicate=='Subject.Grade.Sector.name' &&  reverse==false" class="glyphicon glyphicon-sort-by-alphabet"></span>
				Filière
			</th>
			<th ng-click="predicate='Subject.Grade.name';   reverse=!reverse">
				<span ng-show="predicate=='Subject.Grade.name' &&  reverse==true" class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
				<span ng-show="predicate=='Subject.Grade.name' &&  reverse==false" class="glyphicon glyphicon-sort-by-alphabet"></span>
				Classe</th>
			<th ng-click="predicate='Subject.name';   reverse=!reverse   ">
				<span ng-show="predicate=='Subject.name' &&  reverse==true" class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
				<span ng-show="predicate=='Subject.name' &&  reverse==false" class="glyphicon glyphicon-sort-by-alphabet"></span>
				Matière</th>
			<th ng-click="predicate='Book.name';   reverse=!reverse   ">
				<span ng-show="predicate=='Book.name' &&  reverse==true" class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
				<span ng-show="predicate=='Book.name' &&  reverse==false" class="glyphicon glyphicon-sort-by-alphabet"></span>
				Nom</th>
			<th ng-click="predicate='Stock[0].depot';  reverse=!reverse">
				<span ng-show="predicate=='Stock[0].depot' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[0].depot' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<?php echo $etats[0]['Condition']['name'] ?></th>
			<th ng-click="predicate='Stock[1].depot';  reverse=!reverse">
				<span ng-show="predicate=='Stock[1].depot' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[1].depot' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<?php echo $etats[1]['Condition']['name'] ?></th>
			<th ng-click="predicate='Stock[2].depot';  reverse=!reverse">
				<span ng-show="predicate=='Stock[2].depot' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[2].depot' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<?php echo $etats[2]['Condition']['name'] ?></th>
			<th ng-click="predicate='Stock[0].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[0].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[0].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<?php echo $etats[0]['Condition']['name'] ?></th>
			<th ng-click="predicate='Stock[1].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[1].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[1].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<?php echo $etats[1]['Condition']['name'] ?></th>
			<th ng-click="predicate='Stock[2].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[2].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[2].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<span><?php echo $etats[2]['Condition']['name'] ?></span>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="i in stock | filter:{Subject.Grade.Sector.name: filiere, Subject.Grade.name: classe, Book.name: livre, Subject.name: matiere} | orderBy:predicate:reverse">
			<td>{{i.Subject.Grade.Sector.name}}</td>
			<td>{{i.Subject.Grade.name}}</td>
			<td>{{i.Subject.name}}</td>
			<td>{{i.Book.name}}</td>
			<td ng-repeat="l in i.Stock">
				<span>{{l.depot}}</span>
			</td>
			<td ng-repeat="l in i.Stock">
				<span>{{l.vente}}</span>
			</td>
		</tr>
	</tbody>
</table>	
<?php echo $this->Form->end(); ?>
</div>

<?php 
$this->start('script');
  echo $this->Html->script('stock');
$this->end();
?>

<?php
$this->start('css');
  echo $this->Html->css('vente_depot');
$this->end();
?>