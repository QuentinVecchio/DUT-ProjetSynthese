<div ng-app="Stock" ng-controller="CtrlStockEdit">
	<?php echo $this->Form->create(); ?>
<table class="table table-bordered" ng-init="stock=<?php echo htmlentities(json_encode($stock_edit)) ?>">
	<caption>
			<h4>Renouvellement du stock</h4><br>
	</caption>
	<thead>
		<tr>
			<th colspan="2">Livre</th>
			<th colspan="3">Dépôt</th>
			<th colspan="3">Vente</th>
		</tr>
		<tr>
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
		<tr ng-repeat="i in stock">
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

<link rel="stylesheet" href="https://daneden.me/animate/animate.css">
<script type="text/javascript" source="http://code.angularjs.org/1.2.0/angular-animate.min.js"></script>
<script type="text/javascript" source="http://code.angularjs.org/1.2.5/MINERR_ASSET"></script>

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