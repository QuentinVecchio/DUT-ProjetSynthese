<?php $this->extend('corps_transaction_sale') ?>
<div style="text-align:center;"><h3>Facture de <?php echo $this->Session->read('Transaction.achat.Client.lastname').' '.$this->Session->read('Transaction.achat.Client.name') ?>  </h3></div>
<div style="margin-left : 150px;">
  <p>Facture : du <?php echo date('d/m/Y', time());?></p>
  <p><?php echo $this->Session->read('Transaction.achat.Client.lastname').' '.$this->Session->read('Transaction.achat.Client.name') ?></p>
  <p><?php echo $this->Session->read('Transaction.achat.Client.houseNumber').' '.
          $this->Session->read('Transaction.achat.Client.street').' '.$this->Session->read('Transaction.achat.Town.name').' '.$this->Session->read('Transaction.achat.Town.zip_code'); ?></p>
</div>
<div style="text-align:center;"><h3>Liste des livres</h3></div>
<div>
<table style="margin :auto;">
  <thead>
    <th>Matière</th>
    <th>Nom livre</th>
    <th>Prix.unit €</th>
    <th>Etat</th>
    <th>Réduction %</th>
    <th>Quantité</th>
    <th>Total €</th>
  </thead>

  <tbody>
    <?php foreach ($listLivre as $key => $value) 
    { 
    ?>
        <tr>
          <td><?php echo $value['Row']['name_subject']; ?></td>
          <td><?php echo $value['Row']['name_book']; ?></td>
          <td><?php echo $value['Row']['prize_unit']; ?></td>
          <td><?php echo $value['Row']['name_condition']; ?></td>
          <td><?php echo $value['Row']['reducing']; ?></td>
          <td><?php echo $value['Row']['amount']; ?></td>
          <td><?php echo $value['Row']['prize_total']; ?></td>
        </tr>   
    <?php
    }
   ?>
   <tr>
     <td colspan="5" style="border : none;"></td>
     <td>Total :</td>
     <td><?php echo($this->Session->read('Transaction.achat.total'));?></td>
   </tr>
  </tbody>
</table>
<div style="margin :auto;">
  <h5>Mode de paiement</h5>
  <table>
    <thead>
      <tr>
        <th>Mode paiement</th>
        <th>total payé €</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($transactions as $key => $value): ?>
        <tr>
          <td><?php echo $value['Typereglement']['name'] ?></td>
          <td><?php echo $value['TransactionsTypereglement']['amount'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>

  <?php 
  //debug($listLivre);
$this->start('css'); // indique quel fichier css on utilise
  echo $this->Html->css('facture');
$this->end();  
   ?>