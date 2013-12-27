var app = angular.module('app', [], function() {} );

app.directive('match', function($parse) {
  return {
    require: 'ngModel',
    link: function(scope, elem, attrs, ctrl) {
      scope.$watch(function() {        
        return $parse(attrs.match)(scope) === ctrl.$modelValue;
      }, function(currentValue) {
        ctrl.$setValidity('mismatch', currentValue);
      });
    }
  };
});

app.controller('Controller', function($scope, filterFilter, $http, $location){
  $scope.master = {};
 
  $scope.update = function(user) {
    $scope.master = angular.copy(user);
  };
 
  $scope.reset = function() {
    $scope.user = angular.copy($scope.master);
  };
 
  $scope.isUnchanged = function(user) {
    return angular.equals(user, $scope.master);
  };


 // $scope.villes = [];
  $scope.traitement = function()
  {
    if($scope.Associations.Association.zip_code.length == 5)//Si c'est un code postal alors on fais de l'ajax
    {
      $http.get($scope.urlTown+'/' + $scope.Associations.Association.zip_code).success(function(data)
      {
        $scope.villes = data;
        if($scope.villes.length == 0)
        {
          $scope.existePas = true;
          $scope.existe = false;
        }
        else
        {
          $scope.existe = true;
          $scope.existePas = false;
        }
      });
    }
    else
    {
      $scope.existePas = true;
      $scope.existe = false;
    }
  }

});

