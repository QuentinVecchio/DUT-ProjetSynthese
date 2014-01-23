<?php $this->extend('corps_transaction_sale');
	$facture = current($facture);
  echo $this->Facture->genereFacture($facture['Client'], $facture['Client']['Town'], $facture['Transaction'],$facture['Row'],$facture['Typereglement']); 

echo $this->Html->Link('Valider', array('controller' => 'transactions', 'action' => 'end'), array('class' => 'btn btn-success', 'style' => 'float: right; margin-right: 250px; margin-bottom: 50px;'));

  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  
?>