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
				<h4>Liste des Associations</h4><br>
					<table>
						<thead>
	  						<tr>
			        			<th class="thNom">Nom</th>
			       	 			<th class="thAdresse">Adresse</th>
			       	 			<th class="thMail">Adresse mail</th>
			       	 			<th class="thTelephone">Téléphone</th>
	  						</tr>
						</thead>
   						<tbody>';
						foreach ($listAssoc as $k =>$v)
						{
							$corps .= 
			      			'<tr>
			        			<td>' . $v['Association']['name'] . '</td>
			        			<td>' .  $v['Association']['houseNumber'].' '.$v['Association']['street'].' '.$v['Town']['zip_code'].' '.$v['Town']['name'] . '</td>
			        			<td>' .  $v['Association']['email'] . '</td>
			        			<td>' .  $v['Association']['phone'] . '</td>
			    			</tr>'; 
						}
			$corps .= 
						'</tbody>
					</table>
			';
			//Configuration du pdf
			$nomPdf = 'listeAssociation.pdf';
			$titre = 'Liste des associations';
			$auteur = 'GBL';
			$mode = 'I';
			$pdf = new PDF($nomPdf,$titre,$auteur,$corps,$mode);
			ob_end_clean();
			$pdf->afficher();
?>