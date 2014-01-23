<?php $this->extend('corps_transaction') ?>

<div id="choixPaiement">
  <?php echo $this->Form->create(); ?>
   <?php 
      $option1 = array(
        '0' => 'Remise à la vente'
      );
      $option2 = array(
        '1' => 'Paiement'
      );
      $attributes = array(
        'legend' => false,
        'value' => '0'
      );
  ?>
      
    <fieldset>
      <legend>Choix du mode de paiement</legend>
        <div class="form-group classForm" style="margin-left : 40px;">
          <?php echo $this->Form->input('id', array('value' => $this->Session->read('Transaction.depot.transaction_id'))); ?>
            <label for="close">Statut :</label>
            <?php echo $this->Form->select('close', array(
                                    '0' => 'Remise à la vente',
                                       '1' => 'Paiement')
                                ,array('empty' => false)
                        ); ?>
        </div>
        <?php echo $this->Form->button('Valider', array('class' => 'btn btn-large btn-block btn-success', 'style' => 'border-radius: 0px;',
                                    'ng-disabled' => 'form.$invalid')); ?>
    </fieldset>
  <?php echo $this->Form->end(); ?>
</div>
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