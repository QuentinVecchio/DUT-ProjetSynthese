var app = angular.module('app', [], function() {} );

app.controller('Controller', function($scope, filterFilter, $http, $location){

	$scope.refresh = function(){
		if($scope.search){
			if($scope.search.length > 1){
				$http.get($scope.urlSearch+'/' + $scope.search).success(function(data)
		     	{
			        $scope.Clients = data;
			        if($scope.Clients.length == 0)
			        {
			          $scope.match = false;
			        }
			        else
			        {
			          $scope.match = true;
			        }
			    });
			}
		}
	}
});