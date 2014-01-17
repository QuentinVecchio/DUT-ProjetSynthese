var gestionDemande = angular.module('gestionReglement', []);
 
gestionDemande.controller('ctrl', function FormCtrl($scope) {
	var sauvegarde = new Array();
	$scope.initialisation = function()
	{
		$scope.afficheMode = true;
		$scope.totalBon = parseFloat(0);
		$scope.totalPaiement = parseFloat(0);
		$scope.bon = parseFloat(0);
		$scope.rendu = parseFloat(0);
		$scope.reglement = 0;
		$scope.reglement;
		$scope.reste = $scope.total - $scope.reglement;
		for(i=0;i<$scope.list.length;i++)
		{
			sauvegarde[i] = 0;
		}
	};

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

	$scope.$watch('reglement',function(){
		if($scope.reste < 0)
		{	
			if($scope.totalPaiement > 0 && (($scope.reste - $scope.totalPaiement) < 0))
			{
				if($scope.totalPaiement > $scope.total)
				{
					$scope.afficheMode = true;
				}
				else
				{
					$scope.afficheMode = false;
				}
				$scope.reste -= $scope.totalPaiement;
				$scope.reglement -= $scope.totalPaiement;
				$scope.totalPaiement = 0;
				for(i=0;i<($scope.list.length-2);i++)
				{
					$scope.list[i].Typereglement.amount = 0;
				}
			}
			if($scope.bon > 0)
			{
				$scope.donne = $scope.reglement - $scope.total;
				$scope.rendu = $scope.donne;
			}
			else
			{
				$scope.reste = 0;
			}		
		}
	},true);

	$scope.$watch('totalPaiement',function(){
		if($scope.totalPaiement < 0)
		{	
			$scope.totalPaiement = $scope.reglement = 0;
			$scope.reste = $scope.total;
			for(i=0;i<($scope.list.length-2);i++)
			{
				$scope.list[i].Typereglement.amount = 0;
			}

		}
	},true);

	$scope.initClose = function(close,valeur){
		$scope.totalBon += parseFloat(valeur);
		console.log(close);
		if(close == '0'){
			return false;
		}else{
			return true;
		}
	};

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