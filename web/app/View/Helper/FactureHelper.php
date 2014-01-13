<?php  
	App::uses('AppHelper','View/Helper');
	class FactureHelper extends AppHelper
	{
		public function genereFacture($Transaction,$listeLivre,$listeTransaction)
		{
			ob_start();?>
				<div style="text-align:center;"><h3>Facture de <?php echo $Transaction['achat']['Client']['lastname'].' '.$Transaction['achat']['Client']['name']?>  </h3></div>
				<div style="margin-left : 150px;">
  					<p>Facture : n°<?php echo $Transaction['achat']['transaction_id']?> du <?php echo date('d/m/Y', time())?></p>
  					<p><?php echo $Transaction['achat']['Client']['lastname'].' '.$Transaction['achat']['Client']['name']?></p>
  					<p><?php echo $Transaction['achat']['Client']['houseNumber'].' '.$Transaction['achat']['Client']['street'].' '.$Transaction['achat']['Town']['name'].' '.$Transaction['achat']['Town']['zip_code']?></p>
				</div>
				<div style="text-align:center;">
					<h3>Liste des livres</h3>
				</div>
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
					    <?php foreach ($listeLivre as $key => $value) :?>
					        <tr>
					          <td><?php echo $value['Row']['name_subject']; ?></td>
					          <td><?php echo $value['Row']['name_book']; ?></td>
					          <td><?php echo $value['Row']['prize_unit']; ?></td>
					          <td><?php echo $value['Row']['name_condition']; ?></td>
					          <td><?php echo $value['Row']['reducing']; ?></td>
					          <td><?php echo $value['Row']['amount']; ?></td>
					          <td><?php echo $value['Row']['prize_total']; ?></td>
					        </tr>   
					    <?php endforeach ?>
   							<tr>
						    	<td colspan="5" style="border : none;"></td>
						    	<td>Total :</td>
						    	<td><?php echo $Transaction['achat']['total']?></td>
						   	</tr>
  						</tbody>
					</table>

					<div style="margin-left : 150px;">
					  <h5>Mode de paiement</h5>
					  <table>
					    <thead>
					      <tr>
					        <th>Mode paiement</th>
					        <th>total payé €</th>
					      </tr>
					    </thead>

					    <tbody>
					    <?php foreach ($listeTransaction as $key => $value): ?>
					        <tr>
					          <td><?php echo $value['Typereglement']['name'] ?></td>
					          <td><?php echo $value['TransactionsTypereglement']['amount'] ?></td>
					        </tr>
					    <?php endforeach ?>
					    </tbody>
					  </table>
					</div>
				</div>
			<?php return ob_get_clean();
		}
	}
?>	