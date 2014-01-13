<?php $this->extend('corps_transaction_sale');
	$facture = current($facture);
debug($facture);

	$parent = $facture['Client'];
	$ville = $facture['Client']['Town'];
	$transactions = $facture['Typereglement'];
	debug($transactions);
  echo $this->Facture->genereFacture($parent,$ville, $facture['Transaction'],$facture['Row'],$transactions); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  
?>