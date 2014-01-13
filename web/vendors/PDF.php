<?php
	App::import('vendors','tcpdf/tcpdf'); 
	/**
	* Class PDF qui va nous servir à générer propement un pdf avec en-tete et pied de page
	* La classe PDF hérite de la classe TCPDF
	*/
	class PDF extends TCPDF
	{
		//Variables
			private $_nomPdf;
			private $_titre;
			private $_mode;
			private $_auteur;
			private $_lienImage;
			private $_corps;
			private $_jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"); 
			private $_mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"); 
			private $_date;
		//Constructeur de la classe PDF
			function __construct($nomPdf,$titre,$auteur,$lienImage,$corps,$mode)
			{
				parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$this->SetCreator(PDF_CREATOR);
				$this->setNomPdf($nomPdf);
				$this->setMode($mode);
				$this->setTitre($titre);
				$this->setAuteur($auteur);
				$this->setLienImage($lienImage);
				$this->setCorps($corps);
				$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);		
				$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$this->AddPage();
				$this->writeHTML($corps, true, false, true, false, '');
			}
		//Méthodes diverses
			public function afficher()
			{
				$this->Output($this->_nomPdf,$this->_mode);
			}

			public function Header()
			{
		        //Génration date
		        	$this->_date = $this->_jour[date("w")]." ".date("d")." ".$this->_mois[date("n")]." ".date("Y") . ' à ' .date("H"). ':' .date("i"). ':' .date("s") ;   
		        //Images
			        $image_file = K_PATH_IMAGES.$this->_lienImage;
			        $this->Image($image_file, 180, 4, 15);
		        //Ecriture
		        	$this->SetFont('helvetica', 'B', 10);
		        	$this->SetTextColor(0 , 0, 0);
		        //Titre
			        $this->Cell(15, 8, $this->_titre, 0, true, 'L', 0, '', 0, true);
			        $this->Cell(15, 8, 'Fait par ' . $this->_auteur, 0, true, 'L', 0, '', 0, true);
			        $this->Cell(15, 8, $this->_date, 0, true, 'L', 0, '', 0, true);	
			    //Petite ligne
					$this->Cell(190, 0, '', 'T', 0, 'C');
			}
		//Getters
			public function NomPdf()
			{
				return $this->_nomPdf;
			}

			public function Mode()
			{
				return $this->_mode;
			}

			public function Titre()
			{
				return $this->_titre;
			}

			public function Auteur()
			{
				return $this->_auteur;
			}

			public function LienImage()
			{
				return $this->_lienImage;
			}

			public function Corps()
			{
				return $this->_corps;
			}

		//Setters
			public function setNomPdf($nomPdf)
			{
				$this->_nomPdf = $nomPdf;
			}

			public function setTitre($titre)
			{
				$this->_titre = $titre;
				$this->SetTitle($titre);
				$this->SetSubject($titre);
			}

			public function setMode($mode)
			{
				$this->_mode = $mode;
			}

			public function setAuteur($auteur)
			{
				$this->_auteur = $auteur;
				$this->SetAuthor($auteur);
			}

			public function setLienImage($lienImage)
			{
				$this->_lienImage = $lienImage;
			}

			public function setCorps($corps)
			{
				$this->_corps = $corps;
			}

	}
?>