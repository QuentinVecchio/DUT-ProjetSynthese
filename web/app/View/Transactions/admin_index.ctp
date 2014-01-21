<section>
	<?php $type =(isset($this->data['Transaction']['type']) && !empty($this->data['Transaction']['type'])) ? $this->data['Transaction']['type']: 'tous'; ?>
	<?php $user =(isset($this->data['Transaction']['user_id']) && !empty($this->data['Transaction']['user_id'])) ? $this->data['Transaction']['user_id']: 'tous'; ?>
</section>
<table class="table table-bordered" ng-init="list=<?php echo htmlentities(json_encode($list)) ?>" ng-app="Stock" ng-controller="CtrlStockEdit">
	<caption style="margin-bottom:25px;">
		<h4>Liste factures</h4>
		<div style="height:75px; width:1100px; margin-left:1px;" class="jumbotron">
			<label for="type" style="font-size:15px;margin-right:16px; line-height:2;">Type de facture:</label><input type="text" ng-model="type" id="type" style="width:100px; height:30px; line-height:1;">
			<label for="operateurs" style="font-size:15px;margin-right:16px; margin-left:10px;">Opérateur:</label><input type="text" ng-model="operateurs" id="operateurs" style="width:100px; height:30px; line-height:1;">
			<label for="nom" style="font-size:15px;margin-right:16px; line-height:2;">Nom du parent:</label><input type="text" ng-model="nom" id="nom" style="width:100px; height:30px; line-height:1;">
			<label for="ville" style="font-size:15px;margin-right:16px; margin-left:10px;">Ville:</label><input type="text" ng-model="ville" id="ville" style="width:100px; height:30px; line-height:1;">
		</div>
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
			<tr ng-init="urlFacture='<?php echo $this->Html->Url(array('controller' => 'transactions', 'action' => 'view')) ?>'; VerifData();" 
				ng-repeat="i in list | filter:{Transaction.type: type, User.username: operateurs, Client.lastname: nom, Client.Town.name: ville}">
				<td>{{i.Transaction.date}}</td>
				<td>{{i.Transaction.type}}</td>
				<td>{{i.User.username}}</td>
				<td>{{i.Client.lastname}}&nbsp{{i.Client.name}}</td>
				<td>{{i.Client.houseNumber}}&nbsp{{i.Client.street}}&nbsp{{i.Client.Town.name}}</td>
				<td><a href="{{urlFacture}}/{{i.Transaction.id}}" class="btn btn-primary">Visualiser</a></td>
			</tr>  
	</tbody>
</table>
<?php 
$this->start('script');
  echo $this->Html->script('stock');
$this->end();
?>