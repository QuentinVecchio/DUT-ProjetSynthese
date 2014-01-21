//angular.module('app', ['ngAnimate']);
var app = angular.module('Stock', []);

app.directive('ngBlur', function(){
	return function(scope, elem, attrs){
		elem.bind('blur', function(){
			scope.$apply(attrs.ngBlur);
		})
	}
})
app.controller('CtrlStockEdit', function($scope, filterFilter, $http, $location)
{
	$scope.Stock=[];
	$scope.VerifStock = function(){
		//alert('modif stock');
	}

	$scope.VerifData = function(){
			for(i in $scope.list){
				if($scope.list[i].Client.name == null || $scope.list[i].Client.lastname == null){
					$scope.list[i].Client.name = "supprimé";
					$scope.list[i].Client.lastname = " Parent";
				}
				if($scope.list[i].Client.houseNumber == null || $scope.list[i].Client.street == null){
					$scope.list[i].Client.houseNumber = "Informations";
					$scope.list[i].Client.street = " non disponibles";
				}
			}
	}
});