angular.module('app', ['ngAnimate']);
var app = angular.module('GBL', []);

app.directive('ngBlur', function(){
	return function(scope, elem, attrs){
		elem.bind('blur', function(){
			scope.$apply(attrs.ngBlur);
		})
	}
})
app.controller('CtrlLivres', function($scope, filterFilter, $http, $location)
{
	$scope.mt =0;
	$scope.achats = [];
		
	$scope.$watch('achats', function(){
		console.log('oui');
		$scope.mt = 0;
		$scope.achats.forEach(function(achat){
			var tmp = (achat.book.prize- achat.book.prize*achat.book.etat.conditions.reducing / 100)*achat.book.qte;
			if(tmp != null){
				$scope.mt += tmp;
			}
		})
	}, true)

	$scope.$watch('livres', function(){
		$scope.variable = filterFilter($scope.livres, {completed:true}).length; 
	}, true)

	if($location.path() == '')
		{
		 $location.path('/')
		}
	$scope.location = $location;
	$scope.$watch('location.path()', function(path)
	{
		$scope.statusFilter =
			(path == '/active') ? {completed : false} : null;
			(path == '/done') ? {completed : true} : null;
	});

	var anciens;

	$scope.TransfertLivre = function(){
		$tmp = angular.copy(filterFilter($scope.livres, {"completed":true}));
		for(i in $tmp){
			$scope.achats.push($tmp[i]);			
		}
		$scope.achats.forEach(function(achat){
			if(achat.book.qte == null)
				achat.book.qte = 0;
		})
		$scope.clicked = false;
	}

	$scope.saveAchats = function(){
		$scope.clicked = true;
		console.log($scope.achats);
		if($scope.variable == null)
			$scope.variable = 0;
		 anciens = $scope.achats;
	}

	$scope.removeAchat = function(index){
		$scope.achats.splice(index,1);

	}

	$scope.updateGrades = function(){
		$scope.livres=[];
		$http.get($scope.urlGetGrades+'/'+$scope.choixFiliere.sector.id).success(function(response) {
				      	$scope.classes = response;
				      	console.log($scope.classes);
				    });			
	}

	$scope.updateBooks = function(){
		$http.get($scope.urlGetBooks+'/'+$scope.choixClasse.grade.id).success(function(response) {
						$scope.livres = response;
						console.log($scope.livres);
				    });			

	}

	$scope.duplicateAchat = function(index){
		var original = $scope.achats[index];
		console.log($scope.achats);
		var tmp = {
			book: { id: original.book.id+1, name: original.book.name, prize: original.book.prize, etat: { condition:{id:'', name: "", reducing:''}}, qte: original.book.qte},
			Subject: {name: original.Subject.name},
			completed : true
			};
		$scope.achats.splice(index+1, 0, tmp);
	}

	$scope.editTodo = function(todo){
		todo.editing = false;
	}

	$scope.checkAllTodo = function(allchecked){
		$scope.livres.forEach(function(livre){
			livre.completed = !allchecked;
		})
	}
	
});