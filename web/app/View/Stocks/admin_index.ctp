<table class="table table-bordered" ng-init="stock=<?php echo htmlentities(json_encode($stock_index)) ?>" ng-app="Stock" ng-controller="CtrlStockEdit">
	<caption>
		<h4>Flux quotidiens</h4><br>
		<div style="display:inline-block; margin-bottom:25px;">
			<label for="type" style="margin-right:16px; line-height:2;">Type de transaction:</label><input type="text" ng-model="type" id="type" style="width:150px; height:30px; line-height:1;">
			<label for="conditions" style="margin-right:16px; margin-left:10px;">Conditions:</label><input type="text" ng-model="conditions" id="conditions" style="width:150px; height:30px; line-height:1;">
		</div>
	</caption>
	<thead>
		<tr ng-init="reverse = true">
			<th>Date</th>
			<th>Type</th>
			<th>Livre</th>
			<th>Etat</th>
			<th>Quantité</th>
			<th>Prix</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="i in stock | filter:{Transaction.type: type, Row.name_condition: conditions}">
			<td>{{i.Transaction.date}}</td>
			<td>{{i.Transaction.type}}</td>
			<td>{{i.Row.name_book}}</td>
			<td>{{i.Row.name_condition}}</td>
			<td>{{i.0.amount}}</td>
			<td>{{i.0.total}}</td>
		</tr>
	</tbody>
</table>		
<?php 
$this->start('script');
  echo $this->Html->script('stock');
$this->end();
?>
