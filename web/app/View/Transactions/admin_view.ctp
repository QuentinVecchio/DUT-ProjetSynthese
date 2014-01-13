<h1>Facture:</h1>
<?php debug($facture); ?>
<?php 
	$facture = current($facture);
	$parent = array('Client' => $facture['Client'], 'Town' => $facture['Client']['Town']);
	debug($parent);

	$row = $facture['Row'];
	debug($row);

	$Typereglement = $facture['Typereglement'];
	debug($Typereglement);
  /*echo $this->Facture->genereFacture($this->Session->read('Transaction'),$facture['Row'],$transactions); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end(); 
*/

 ?>