<?php 
	App::import('vendors','PDF'); 
	//Génération du pdf
		//Ajout de ce que l'on veut mettre dans le pdf
			//Ajout du style
				$corps = '
					<style>
						h4
						{
							margin : auto;
							text-align : center;
						}
						table
						{
							border : 1px solid black;
							padding : 5px;
						}
						th,td
						{
							text-align: center;
							border : 1px solid black;
						}
					</style>
				';
			//Ajout du contenu
			$corps .= 
				'<br/><br/><br/><br/>
				<h4>Liste des Parents</h4><br>
					<table>
						<thead>
	  						<tr>
			        			<th class="thNom">Nom</th>
					       	 	<th class="thAdresse">Adresse</th>
					       	 	<th class="thMail">Email</th>
					       	 	<th class="thTelephone">Téléphone</th>
					       	 	<th class="thAssoc">Association</th>
	  						</tr>
						</thead>
   						<tbody>';
						foreach ($listParent as $k =>$v)
						{
							$corps .= 
			      			'<tr>
			        			<td>' . $v['Client']['name'].' '.$v['Client']['lastname'] . '</td>
			        			<td>' . $v['Client']['houseNumber'].' '.$v['Client']['street'] . (isset($v['Town']) && !empty($v['Town']))?' '.$v['Town']['name'].' '.$v['Town']['zip_code']:'' .'</td>
			        			<td>' .  $v['Client']['email'] . '</td>
			        			<td>' .  $v['Client']['phone'] . '</td>
			        			<td>' . $v['Association']['name'] . '</td>
			    			</tr>'; 
						}
			$corps .= 
						'</tbody>
					</table>
			';
			//Configuration du pdf
			$nomPdf = 'listeParents.pdf';
			$titre = 'Liste des Parents';
			$auteur = 'GBL';
			$lienImage = 'logo.png';
			$mode = 'I';
			$pdf = new PDF($nomPdf,$titre,$auteur,$lienImage,$corps,$mode);
			ob_end_clean();
			$pdf->afficher();
?>