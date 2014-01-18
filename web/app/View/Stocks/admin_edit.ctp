<div ng-app="Stock" ng-controller="CtrlStockEdit">
	<label for="">Filiere:</label><input type="text" ng-model="filiere">
	<label for="">Classe:</label><input type="text" ng-model="classe">
	<label for="">Matière:</label><input type="text" ng-model="matiere">
	<label for="">Livre:</label><input type="text" ng-model="livre">


	<?php echo $this->Form->create(); ?>
<table class="table table-bordered" ng-init="stock=<?php echo htmlentities(json_encode($stock_edit)) ?>">
	<caption>
			<h4>Renouvellement du stock</h4><br>
	</caption>
	<thead>
		<tr>
			<th colspan="4">Livre</th>
			<th colspan="3">Dépôt</th>
			<th colspan="3">Vente</th>
		</tr>
		<tr>
			<th>Filière</th>
			<th>Classe</th>
			<th>Matière</th>
			<th>Nom</th>
			<th>Bon</th>
			<th>Moyen</th>
			<th>Médiocre</th>
			<th>Bon</th>
			<th>Moyen</th>
			<th>Médiocre</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="i in stock | filter:{Subject.Grade.Sector.name: filiere, Subject.Grade.name: classe, Book.name: livre, Subject.name: matiere}">
			<td>{{i.Subject.Grade.Sector.name}}</td>
			<td>{{i.Subject.Grade.name}}</td>
			<td>{{i.Subject.name}}</td>
			<td>{{i.Book.name}}</td>
			<td ng-repeat="l in i.Stock">
				<input type="number" min="0" name="{{$parent.$index*10 + $index}}[Stock][depot]" style="width:50px;height:25px;text-align:center;" ng-model="l.depot">
				<input type="text" min="0" name="{{$parent.$index*10 + $index}}[Stock][id]" style="width:50px;height:25px;text-align:center;" ng-model="l.id" ng-show="false">
			</td>
			<td ng-repeat="l in i.Stock">
				<input type="number" min="0" name="{{$parent.$index*10 + $index}}[Stock][vente]" style="width:50px;height:25px;text-align:center;" ng-model="l.vente">
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