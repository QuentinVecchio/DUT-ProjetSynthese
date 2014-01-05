<?php $this->extend('corps_transaction_sale') ?>
 <h2>Facture de <?php echo $this->Session->read('Transaction.achat.Client.lastname').' '.$this->Session->read('Transaction.achat.Client.name') ?>	</h2>

<h4>Récapitulatif informations Parent</h4>
<!--<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Adresse</th>
      <th>Mail</th>
      <th>Téléphone</th>
    </tr>
  </thead>
  <tbody>
    <td><?php echo $this->Session->read('Transaction.achat.Client.lastname') ?></td>
    <td><?php echo $this->Session->read('Transaction.achat.Client.name') ?></td>
    <td><?php echo $this->Session->read('Transaction.achat.Client.houseNumber').' '.
    			$this->Session->read('Transaction.achat.Client.street').' '.$this->Session->read('Transaction.achat.Town.name').' '.$this->Session->read('Transaction.achat.Town.zip_code'); ?></td>
    <td><?php echo $this->Session->read('Transaction.achat.Client.email'); ?></td>
    <td><?php echo $this->Session->read('Transaction.achat.Client.phone'); ?></td>
  </tbody>
</table>

<h4>Mode de paiement</h4>
<table>
  <tr>
    <td class="cache">Mode de paiement :</td>
    <td class="cache">Chèque</td>
  </tr>
</table>
<h4>Liste des livres</h4>
<table id="listLivre">
    <thead>
       <tr>
           <th>Nom livre</th>
           <th>Matière</th>
           <th>Etat</th>
           <th>Quantité</th>
           <th>Prix Initial €</th>
           <th>Prix €</th>
       </tr>
    </thead>
 <tbody>
 	<?php 
 		$total = 0;
 		foreach ($listLivre as $key => $value): 

 		$current_prize = (intval($value['Transaction']['amount'])* (intval($value['Book']['prize'])-intval($value['Book']['prize'])*intval($value['Condition']['reducing'])/100));
 		$total += $current_prize;
 	?>
 		<tr>
 			<td><?php echo $value['Book']['name']?> </td>
 			<td><?php echo $value['Subject']['name']?> </td>
 			<td><?php echo $value['Condition']['name']?> </td>
 			<td><?php echo $value['Transaction']['amount']?> </td>
 			<td><?php echo $value['Book']['prize']?> </td>
 			<td><?php echo $current_prize?> </td>
 		</tr>
 	<?php endforeach; ?>
 </tbody>
<tfoot>
  <tr>
    <td colspan="4" class="cache"></td>
    <td>Prix total : </td>
    <td><?php echo $total; ?></td>
  </tr>
</tfoot>
</table>
<div id="listEtat">

  <h4>Liste des états</h4>
   <table>
     <thead>
       <tr>
         <th>Etat</th>
         <th>Remise</th>
       </tr>
     </thead>

     <tbody>
		<?php foreach ($listCondition as $key => $value):?>
	           <tr>
	             <td><?php echo $value['Condition']['name'] ?></td>
	             <td><?php echo $value['Condition']['reducing'].'%' ?></td>
	           </tr>
		<?php endforeach; ?>          
     </tbody>
   </table>
  </div>
  <div id="signature">
    <table>
      <tr>
        <td>Fait le : <?php echo date('d/m/Y', time());?> à Briey</td>
      </tr>
      <tr>
        <td>Signature :</td>
        <td style="width : 60px; height : 50px;"></td>
      </tr>
    </table>
  </div>
-->
  <?php 

  debug($listLivre);


$this->start('css'); // indique quel fichier css on utilise
  echo $this->Html->css('facture');
$this->end();  
   ?>