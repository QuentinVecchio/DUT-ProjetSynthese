<?php $this->extend('corps_transaction_sale');
  echo $this->Facture->genereFacture($this->Session->read('Transaction'),$listLivre,$transactions); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  
?>