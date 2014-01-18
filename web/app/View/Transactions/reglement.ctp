<?php $this->extend('corps_transaction_sale') ?>
<section ng-app="gestionReglement" ng-Controller="ctrl" ng-init="list=<?php echo htmlentities(json_encode($listTypeReglement))?>;
																transactionId=<?php echo $this->Session->read('Transaction.achat.transaction_id') ?>;
																total=<?php echo $this->Session->read('Transaction.achat.total');?>;
																initialisation();
																oldTransaction=<?php echo htmlentities(json_encode($oldTransaction)) ?>">
<?php //debug($oldTransaction) ?>

	<h1 style="text-align : center;">Règlement</h1>
	<div class="formulaire" style="width: 300px;padding: 10px;margin: auto;margin-top : 10px;">
		<fieldset>
			<?php echo $this->Form->create(''); ?>
				<fieldset >
					<legend>Remise : </legend>
					<ul>
						<li ng-repeat="t in oldTransaction">
							<input type="text" name="data[Transaction][{{$index}}][id]" ng-model="t.Transaction.id" >
							<input type="text" name="data[Transaction][{{$index}}][total]" ng-model="t.Transaction.total" >
							<input type="checkbox" name="data[Transaction][{{$index}}][close]" ng-model="t.Transaction.isClose" ng-init="t.Transaction.isClose = initClose(t.Transaction.close,t.Transaction.total)" ng-change="utilise(t.Transaction.isClose,t.Transaction.total)"><label for="">Bon du {{t.Transaction.date}} de {{t.Transaction.total}}€</label>
						</li>
					</ul>
					<p style="text-align : ">Valeur total des bons : {{totalBon}}€</p>
				</fieldset>
				<fieldset>
					<legend>Règlement : </legend>
					<div ng-repeat="i in list">
						<div ng-if="i.Typereglement.name != 'Bon' && i.Typereglement.name != 'Rendu'" ng-show="afficheMode">
							<label>{{i.Typereglement.name}} :</label>
							<input type="number" min="0" step="0.01" name="data[{{$index}}][amount]"  ng-init="i.Typereglement.amount = i.TransactionsTypereglement[0].amount || 0"  ng-model="i.Typereglement.amount" ng-change="traitement($index)">
							<input style="visibility : hidden; width :20px;"  ng-model="i.Typereglement.id" name="data[{{$index}}][typereglement_id]">
							<input style="visibility : hidden; width :20px;;" type="text" ng-model="i.Typereglement.transaction_id" ng-init="i.Typereglement.transaction_id = transactionId" name="data[{{$index}}][transaction_id]">
						</div>
						
						<div ng-if="i.Typereglement.name == 'Bon'" ng-show="bon > 0">
							<label>{{i.Typereglement.name}} :</label>
							<span name="data[{{$index}}][amount]" ng-model="bon">{{bon}}€</span>
							<input style="display:none;"  ng-model="bon" name="data[{{$index}}][amount]">
							<input style="display:none;"  ng-model="i.Typereglement.id" name="data[{{$index}}][typereglement_id]">
							<input style="display:none;" type="text" ng-model="i.Typereglement.transaction_id" ng-init="i.Typereglement.transaction_id = transactionId" name="data[{{$index}}][transaction_id]">
						</div>

						<div ng-if="i.Typereglement.name == 'Rendu'" ng-show="bon > 0">
							<label>{{i.Typereglement.name}} :</label>
							<span name="data[{{$index}}][amount]" ng-model="rendu">{{rendu}}€</span>
							<input style="display:none;"  ng-model="i.Typereglement.id" name="data[{{$index}}][typereglement_id]">
							<input style="display:none;"  ng-model="rendu" name="data[{{$index}}][amount]">
							<input style="display:none;" type="text" ng-model="i.Typereglement.transaction_id" ng-init="i.Typereglement.transaction_id = transactionId" name="data[{{$index}}][transaction_id]">
						</div>		
					</div>
					<div style="text-align : left;padding-left: 10px;">
						<span ng-show="reste < 0">Vous devez <span style="color :red;font-weight:bold;">{{donne | number:2}}</span> € au client.</span>
						<span ng-show="reste > 0">Il reste <span style="font-weight: bold;">{{reste | number:2}}</span> € à payer.</span>
						<span ng-show="reglement == total" style="color : green;">Le client a tout réglé.</span>
					</div>
					<input ng-disabled="reglement < total" type="submit" value="Payer" class="btn btn-success" style="margin-left: 200px;">
					</fieldset>
			<?php echo $this->Form->end(); ?>
		</fieldset>
	</div>
<?php 
$this->start('script');
  echo $this->Html->script('reglement');
$this->end();

 ?>