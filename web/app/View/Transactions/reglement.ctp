<?php $this->extend('corps_transaction_sale') ?>
<section ng-app="gestionReglement" ng-Controller="ctrl" ng-init="list=<?php echo htmlentities(json_encode($listTypeReglement))?>;
																transactionId=1">
		<?php
		
		/**
		*	La valeur total de l'achat que je ne peux pas te fournir pour le moment
		*	La somme des choix de paiement avec la quantité doit être égale a ce montant, sinon on ne peut pas valider (logique);
		*/
		 $total = 100.00; debug($total); 
		 /**
		 *	Je t'ai mis un petit squelette de ce qu'il me faut (l'ajout en BDD fonctionne)
		 *	Les contraintes sont donc:
		 *				- La somme des paiements doit faire le total
		 *				- Il faut qu'on trouve un moyen d'écarter les champs non remplit
		 *				- J'ai préférer tout afficher, parce que faire des menus déroulants et ajout suppression serait plus chaud (mais tu peux essayer)
		 *
		 *	Il y a un bug sur ng-model="i.TransactionsTypereglement[0].amount", il essaye de prendre une valeur de quelque chose qui n'existe pas
		 *		Je ne vois pas comment faire pour le moment, c'est la ligne est nécessaire pour récupérer les valeurs lors d'un retour en arrière
		 *
		 *	GOOD LUCK
		 *
		 */

		 ?>

		<?php debug($listTypeReglement); ?>


		<h1>Affichage avec Angularjs</h1>

		<?php echo $this->Form->create(); ?>
			<div ng-repeat="i in list">
				<input type="text" ng-model="i.Typereglement.id" name="data[{{$index}}][typereglement_id]">
				<input type="text" ng-model="i.Typereglement.transaction_id" ng-init="i.Typereglement.transaction_id = transactionId" name="data[{{$index}}][transaction_id]">
				<input type="text" name="data[{{$index}}][amount]" ng-model="i.TransactionsTypereglement[0].amount">
			</div>
			<input type="submit" value="Envoyer">
		<?php echo $this->Form->end(); ?>

</section>
<?php 
$this->start('script');
  echo $this->Html->script('reglement');
$this->end();

 ?>