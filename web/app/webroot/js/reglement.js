var gestionDemande = angular.module('gestionReglement', []);
 
gestionDemande.controller('ctrl', function FormCtrl($scope) {
	var sauvegarde = new Array();
	$scope.initialisation = function()
	{
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
		$scope.reste = $scope.total - $scope.reglement;
	};

	$scope.$watch('reglement',function(){
		if($scope.reste < 0)
		{
			$scope.donne = 0 - $scope.reste;
		}
	},true);

	
});