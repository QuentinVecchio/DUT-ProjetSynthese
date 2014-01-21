var gestionDemande = angular.module('gestionReglement', []);
 
gestionDemande.controller('ctrl', function FormCtrl($scope) {
	var sauvegarde = new Array();
	
	/*
	*	Fonction qui initialise le reglement
	*/
	$scope.initialisation = function()
	{
		$scope.afficheMode = true;
		$scope.totalBon = parseFloat(0);//Valeur total des bon pouvant être utilisé
		$scope.totalPaiement = parseFloat(0);//Variable qui est égal au total de ce qu'à payé le client avec les modes de paiement
		$scope.bon = parseFloat(0); //Variable qui est égal au total des bon utilisé 
		$scope.rendu = parseFloat(0); // Ce qu'on va rendre au client
		$scope.reglement = 0; //Variable qui est égal au total de ce qu'à payé le client et les bons
		$scope.reste = $scope.total - $scope.reglement;//Le reste à payer
		for(i=0;i<$scope.list.length;i++)
		{
			sauvegarde[i] = 0;
		}
	};

	/*
	* Fonction qui gère quand on ajoute de l'argent via les modes de paiements
	*/
	$scope.traitement = function(valeur)
	{
		$scope.reglement -= sauvegarde[valeur];
		$scope.totalPaiement -= sauvegarde[valeur];
		if(angular.isNumber($scope.list[valeur].Typereglement.amount) == false)
		{
	
			$scope.list[valeur].Typereglement.amount = 0;
			sauvegarde[valeur] = parseFloat($scope.list[valeur].Typereglement.amount);
		}
		else
		{
			sauvegarde[valeur] = parseFloat($scope.list[valeur].Typereglement.amount);
		}
		$scope.reglement += sauvegarde[valeur];
		$scope.totalPaiement += sauvegarde[valeur];
		$scope.reste = $scope.total - $scope.reglement;
	};

	/*
	* Fonction qui gère quand le client 
	*/
	$scope.$watch('reglement',function(){
		if($scope.reste < 0)
		{	
			$scope.donne =  -($scope.total - $scope.reglement);
		}
	},true);

	/*
	* Fonction qui gère quand le client 
	*/
	$scope.$watch('bon',function(){
		if($scope.bon > 0)
		{
			$scope.variable = ($scope.total - $scope.bon);
			if($scope.variable <= 0)
			{
				$scope.donne -= $scope.totalPaiement;
				$scope.reglement -= $scope.totalPaiement;
				for(i=0;i<($scope.list.length);i++)
				{
					$scope.list[i].Typereglement.amount = 0;
					sauvegarde[i] = 0;
				}
				$scope.totalPaiement = 0;
				$scope.afficheMode = false;
			}
		}
	},true);

	/*
	* Foction qui gère quand le client paye plus que ce qu'on lui demande via les modes de paiements
	*/
	$scope.$watch('totalPaiement',function(){
		if($scope.totalPaiement > $scope.total)
		{	
			alert('ok1');
			$scope.totalPaiement = $scope.reglement = 0;
			$scope.reste = $scope.total;
			for(i=0;i<($scope.list.length);i++)
			{
				$scope.list[i].Typereglement.amount = 0;
				sauvegarde[i] = 0;
			}
			$scope.totalPaiement = 0;
			$scope.afficheMode = true;
		}
	},true);

	/*
	*	Fonction qui initialise les bon
	*/
	$scope.initClose = function(close,valeur){
		$scope.totalBon += parseFloat(valeur);
		console.log(close);
		if(close == '0'){
			return false;
		}else{
			return true;
		}
	};

	/*
	*	Fonction qui gère l'utilisation des bons
	*/
	$scope.utilise = function(estUtil,valeur)
	{
		if(estUtil == true)
		{
			$scope.bon += parseFloat(valeur);
			$scope.reglement += parseFloat(valeur);
			$scope.reste = $scope.total - $scope.reglement;
		}	
		else
		{
			$scope.bon -= parseFloat(valeur);
			$scope.reglement -= parseFloat(valeur);
			$scope.reste = $scope.total - $scope.reglement;
			$scope.afficheMode = true;
		}
	};
	
});