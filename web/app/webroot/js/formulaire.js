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
    if($scope.Associations.Town){

      if($scope.Associations.Town.zip_code.length <= 5 &&
          $scope.Associations.Town.zip_code.length > 2)//Si c'est un code postal alors on fais de l'ajax
      {
        $scope.traitementCodePostal($scope.Associations.Town.zip_code);
      }
      else
      {
        $scope.existePas = true;
        $scope.existe = false;
      }
    }
  };

  $scope.traitementCodePostal = function(zip_code)
  {
      $http.get($scope.urlTown+'/' + zip_code).success(function(data)
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
      })
  };

  $scope.initTown = function(){
    if($scope.Associations.Town){
      $scope.Associations.Association.town_id = {Town: $scope.Associations.Town};
    }
  }

  $scope.updateZipCode = function(){
    $scope.Associations.Town.zip_code = $scope.Associations.Association.town_id.Town.zip_code;
  }

  $scope.traitement2 = function()
  {
     if($scope.Clients.Town){
        if($scope.Clients.Town.zip_code.length <= 5 &&
            $scope.Clients.Town.zip_code.length > 2)//Si c'est un code postal alors on fais de l'ajax
        {
          $scope.traitementCodePostal($scope.Clients.Town.zip_code);
        }
        else
        {
          $scope.existePas = true;
          $scope.existe = false;
        }
    }
  };

  $scope.initTown2 = function(){
    if($scope.Clients.Town){
      $scope.Clients.Client.town_id = {Town: $scope.Clients.Town};
    }
  }

  $scope.updateZipCode2 = function(){
    $scope.Clients.Town.zip_code = $scope.Clients.Client.town_id.Town.zip_code;
  }




angular.element(document).ready(function () {
  if($scope.Clients){
    $scope.traitement2();
  }else{
      $scope.traitement();
  }
});

});

