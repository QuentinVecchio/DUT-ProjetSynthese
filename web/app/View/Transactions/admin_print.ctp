<?php 
	App::import('vendors','PDF'); 
	//Génération du pdf
		//Ajout de ce que l'on veut mettre dans le pdf
						//Ajout du contenu
						$corps = 
						'<style>
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
						</style>'; 
						$facture=current($facture);
						$corps .= $this->Facture->genereFacture($facture['Client'], $facture['Client']['Town'], $facture['Transaction'],$facture['Row'],$facture['Typereglement']);
			//Configuration du pdf
			$nomPdf = 'facture.pdf';
			$titre = 'Facture';
			$auteur = 'GBL';
			$lienImage = 'logo.png';
			$mode = 'I';
			$pdf = new PDF($nomPdf,$titre,$auteur,$lienImage,$corps,$mode);
			ob_end_clean();
			$pdf->afficher();
?>