<?php $this->extend('corps_transaction') ?>
<section ng-app="app" ng-controller="Controller">
	<h2>Le parent: <?php echo $this->Session->read('Transaction.Client.name').' '.$this->Session->read('Transaction.Client.lastname'); ?></h2>
	<h1>Dépôt des livres:</h1>

</section>
