<?php  
	App::uses('AppHelper','View/Helper');
	class FactureHelper extends AppHelper
	{
		public function genereFacture($parent,$ville, $Transaction,$listeLivre,$listeTransaction)
		{
			ob_start();?>
				<br><br>
				<div style="text-align:center;"><h3>Facture de <?php echo $parent['lastname'].' '.$parent['name']?>  </h3></div>
				<div style="margin-left : 150px;">
  					<p>Facture : n°<?php echo $Transaction['id']?> du <?php echo date('d/m/Y', time())?></p>
  					<p><?php echo $parent['lastname'].' '.$parent['name']?></p>
  					<p><?php echo $parent['houseNumber'].' '.$parent['street'].' ';
  							if(!empty($ville)){ echo $ville['name'].' '.$ville['zip_code'];};?>
  					</p>
				</div>
				<div style="text-align:center;">
					<h3>Liste des livres</h3>
				</div>
				<div>
					<table style="margin :auto;">
  						<thead>
  							<tr>
							    <th colspan="2">Matière</th>
							    <th colspan="2">Nom livre</th>
							    <th>Prix €</th>
							    <th>Etat</th>
								<th>Réduc %</th>
							    <th>Quantité</th>
							    <th>Total €</th>
							</tr>
						</thead>

  						<tbody>
					    <?php foreach ($listeLivre as $key => $value) :?>
					        <tr>
					          <td colspan="2"><?php echo $value['name_subject']; ?></td>
					          <td colspan="2"><?php echo $value['name_book']; ?></td>
					          <td><?php echo $value['prize_unit']; ?></td>
					          <td><?php echo $value['name_condition']; ?></td>
					          <td><?php echo $value['reducing']; ?></td>
					          <td><?php echo $value['amount']; ?></td>
					          <td><?php echo $value['prize_total']; ?></td>
					        </tr>   
					    <?php endforeach ?>
   							<tr>
						    	<td colspan="7" style="border : none;"></td>
						    	<td>Total :</td>
						    	<td><?php echo $Transaction['total']?></td>
						   	</tr>
  						</tbody>
					</table>

					<div style="margin-left : 150px;">
					  <h5>Mode de paiement</h5>
					  <table>
					    <thead>
					      <tr>
					        <th>Mode paiement</th>
					        <th>Total payé €</th>
					      </tr>
					    </thead>

					    <tbody>
					    <?php foreach ($listeTransaction as $key => $value): ?>
					        <tr>
					          <td><?php echo $value['name'] ?></td>
					          <td><?php echo $value['TransactionsTypereglement']['amount'] ?></td>
					        </tr>
					    <?php endforeach ?>
					    </tbody>
					  </table>
					</div>
				</div>
			<?php return ob_get_clean();
		}

		public function genereFacturePdf($parent,$ville, $Transaction,$listeLivre,$listeTransaction)
		{
			ob_start();?>
				<br><br>
				<h3 style="text-align:center;">Facture de <?php echo $parent['lastname'].' '.$parent['name']?>  </h3>
  				<p>Facture : n° <?php echo $Transaction['id']?> du <?php echo date('d/m/Y', time())?></p>
  				<p><?php echo $parent['lastname'].' '.$parent['name']?></p>
				<p><?php echo $parent['houseNumber'].' '.$parent['street'].' ';
						if(!empty($ville)){ echo $ville['name'].' '.$ville['zip_code'];};?>
				</p>
				<h3 style="text-align:center;">Liste des livres</h3>
				<table style="margin :auto;">
  					<thead>
  						<tr>
						    <th colspan="2">Matière</th>
						    <th colspan="2">Nom livre</th>
						 	<th>Prix €</th>
							<th>Etat</th>
							<th>Réduc %</th>
							<th>Quantité</th>
							<th>Total €</th>
						</tr>
					</thead>

  					<tbody>
					<?php foreach ($listeLivre as $key => $value) :?>
					    <tr>
			      			<td colspan="2"><?php echo $value['name_subject']; ?></td>
					        <td colspan="2"><?php echo $value['name_book']; ?></td>
					        <td><?php echo $value['prize_unit']; ?></td>
					        <td><?php echo $value['name_condition']; ?></td>
					        <td><?php echo $value['reducing']; ?></td>
					        <td><?php echo $value['amount']; ?></td>
					        <td><?php echo $value['prize_total']; ?></td>
					    </tr>   
					 <?php endforeach ?>
   						<tr>
						    <td colspan="7" bgcolor="black"></td>
						    <td>Total :</td>
						    <td><?php echo $Transaction['total']?></td>
						</tr>
  					</tbody>
				</table>

				<h5 style="margin-left : 150px;">Mode de paiement</h5>
				<table>
					<thead>
					    <tr>
					    	<th>Mode paiement</th>
					        <th>Total payé €</th>
					    </tr>
					</thead>

					<tbody>
					<?php foreach ($listeTransaction as $key => $value): ?>
					    <tr>
					        <td><?php echo $value['name'] ?></td>
					        <td><?php echo $value['TransactionsTypereglement']['amount'] ?></td>
					    </tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php return ob_get_clean();
		}
	}
?>	