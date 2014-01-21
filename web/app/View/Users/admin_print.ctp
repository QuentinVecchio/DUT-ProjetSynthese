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
				<h4>Liste des Utilisateurs</h4><br>
					<table>
						<thead>
	  						<tr>
			        			<th class="thNom">Nom</th>
       	 						<th class="thStatut">Statut</th>
	  						</tr>
						</thead>
   						<tbody>';
						foreach ($listUser as $k =>$v)
						{
							$corps .= 
			      			'<tr>
			        			<td>' . $v['User']['username'] . '</td>
			        			<td>' . $v['User']['status'] .'</td>
			    			</tr>'; 
						}
			$corps .= 
						'</tbody>
					</table>
			';
			//Configuration du pdf
			$nomPdf = 'listeUtilisateur.pdf';
			$titre = 'Liste des Utilisateurs';
			$auteur = 'GBL';
			$lienImage = 'logo.png';
			$mode = 'I';
			$pdf = new PDF($nomPdf,$titre,$auteur,$lienImage,$corps,$mode);
			ob_end_clean();
			$pdf->afficher();
?>