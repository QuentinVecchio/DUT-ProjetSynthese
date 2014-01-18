<div ng-app="Stock" ng-controller="CtrlStockEdit">
	<label for="">Filiere:</label><input type="text" ng-model="filiere">
	<label for="">Classe:</label><input type="text" ng-model="classe">
	<label for="">Matière:</label><input type="text" ng-model="matiere">
	<label for="">Livre:</label><input type="text" ng-model="livre">


<table class="table table-bordered" ng-init="stock=<?php echo htmlentities(json_encode($stock)) ?>">
	<caption>
			<h4>Visualisation du stock</h4><br>
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
				Bon</th>
			<th ng-click="predicate='Stock[1].depot';  reverse=!reverse">
				<span ng-show="predicate=='Stock[1].depot' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[1].depot' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				Moyen</th>
			<th ng-click="predicate='Stock[2].depot';  reverse=!reverse">
				<span ng-show="predicate=='Stock[2].depot' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[2].depot' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				Médiocre</th>
			<th ng-click="predicate='Stock[0].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[0].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[0].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				Bon</th>
			<th ng-click="predicate='Stock[1].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[1].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[1].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				Moyen</th>
			<th ng-click="predicate='Stock[2].vente';  reverse=!reverse">
				<span ng-show="predicate=='Stock[2].vente' &&  reverse==false" class="glyphicon glyphicon-sort-by-attributes"></span>
				<span ng-show="predicate=='Stock[2].vente' &&  reverse==true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
				<span>Médiocre</span>
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
<input id="BtnSubmit" type="submit" ng-click="VerifStock()" value="Enregistrer" class="btn btn-success">
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