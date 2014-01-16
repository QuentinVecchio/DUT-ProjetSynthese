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
});