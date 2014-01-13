<h1>Facture:</h1>
<?php echo $this->Html->Link('< Retourner à la liste des factures', array('controller' => 'transactions', 'action' => 'index', 'admin' => true),
																array('class' => 'btn btn-primary')) ?>
<?php

	$facture = current($facture);
  echo $this->Facture->genereFacture($facture['Client'], $facture['Client']['Town'], $facture['Transaction'],$facture['Row'],$facture['Typereglement']); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  
 ?>