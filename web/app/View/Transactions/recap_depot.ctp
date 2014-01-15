<?php $this->extend('corps_transaction_sale') ?>

<section>
  <?php echo $this->Form->create(); ?>
 <?php 
        $options = array(
            '0' => 'Garder pour plus tard',
            '1' => 'Utiliser tout de suite'
        );

        $attributes = array(
            'legend' => false,
            'value' => '0'
        );

      echo $this->Form->input('id', array('style' => 'display:none;', 'value' => $this->Session->read('Transaction.depot.transaction_id')));
      echo $this->Form->radio('close', $options, $attributes);


  ?>
  <?php echo $this->Form->end('Valider'); ?>
</section>



  <?php 
  $facture = current($facture);
  echo $this->Facture->genereFacture($facture['Client'], $facture['Client']['Town'], $facture['Transaction'],$facture['Row'],$facture['Typereglement']); 
  $this->start('css'); // indique quel fichier css on utilise
    echo $this->Html->css('facture');
  $this->end();  

  //debug($listLivre);
$this->start('css'); // indique quel fichier css on utilise
  echo $this->Html->css('facture');
$this->end();  
   ?>