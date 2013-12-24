function Controller($scope, $http) {
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

};

