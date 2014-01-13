<?php $this->extend('corps_transaction_sale') ?>
<section ng-app="gestionReglement" ng-Controller="ctrl" ng-init="list=<?php echo htmlentities(json_encode($listTypeReglement))?>;
																transactionId=<?php echo $this->Session->read('Transaction.achat.transaction_id') ?>;
																total=<?php echo $this->Session->read('Transaction.achat.total');?>;
																initialisation();">
	<h1>Règlement</h1>
	<div class="formulaire" style="height : 200px;width: 300px;padding: 10px;margin: auto;">
		<?php echo $this->Form->create(); ?>
			<div ng-repeat="i in list">
				<label>{{i.Typereglement.name}} :</label>
				<input type="number" min="0" step="0.01" name="data[{{$index}}][amount]"  ng-init="i.Typereglement.amount = i.TransactionsTypereglement[0].amount || 0"  ng-model="i.Typereglement.amount" ng-change="traitement($index)">
				<input style="visibility : hidden;"  ng-model="i.Typereglement.id" name="data[{{$index}}][typereglement_id]">
				<input style="visibility : hidden;" type="text" ng-model="i.Typereglement.transaction_id" ng-init="i.Typereglement.transaction_id = transactionId" name="data[{{$index}}][transaction_id]">			
			</div>
			<span ng-show="reste < 0">Vous devez {{donne}} € au client.</span><span ng-show="reste >= 0">Il reste {{reste}} € à payer.</span>
			<input ng-disabled="reglement != total"type="submit" value="Envoyer" class="btn btn-primary" style="margin-left: 175px;">
		<?php echo $this->Form->end(); ?>
	</div>
<?php 
$this->start('script');
  echo $this->Html->script('reglement');
$this->end();

 ?>