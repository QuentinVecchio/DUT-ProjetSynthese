<h1>Facture:</h1>
<a class="btn btn-primary" href="<?php echo $this->Html->url( array('controller' => 'transactions', 'action' => 'index', 'admin' => true)) ?>">

<span class="glyphicon glyphicon-chevron-left"></span>
	Retourner à la liste des factures</a>
<?php

	$facture = current($facture);
	$town = (isset($facture['Client']['Town']) && !empty($facture['Client']['Town']))? $facture['Client']['Town']: array();
  echo $this->Facture->genereFacture($facture['Client'], $town, $facture['Transaction'],$facture['Row'],$facture['Typereglement']); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  
  echo $this->Html->Link('Imprimer', array('controller' => 'transactions', 'action' => 'print', $facture['Transaction']['id']), array('class' => 'btn btn-primary', 'style' => 'margin-left : 20px;'));
 ?>