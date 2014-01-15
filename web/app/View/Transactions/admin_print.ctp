<?php 
	App::import('vendors','PDF'); 
	//Génération du pdf
		//Ajout de ce que l'on veut mettre dans le pdf
						//Ajout du contenu
						$corps = 
						'<style>
							table
							{
							  border-collapse: collapse; /* Les bordures du tableau seront collées (plus joli) */
							}
							td,th
							{ 
							  padding: 5px;
							  border: 1px solid black;
							  text-align : center
							}
						</style>'; 
						$facture=current($facture);
						$corps .= $this->Facture->genereFacturePdf($facture['Client'], $facture['Client']['Town'], $facture['Transaction'],$facture['Row'],$facture['Typereglement']);
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