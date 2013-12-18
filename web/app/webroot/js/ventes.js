angular.module('app', ['ngAnimate']);
var app = angular.module('todo', []);

app.directive('ngBlur', function(){
	return function(scope, elem, attrs){
		elem.bind('blur', function(){
			scope.$apply(attrs.ngBlur);
		})
	}
})
/**
* =================================
* Controller pour le choix du livre
* =================================
*/
app.controller('CtrlLivres', function($scope, filterFilter, $http, $location)
{
	/**
	* $scope pour le choix des livres
	*
	*/
//	$scope.filieres = [  {"name": "S", "completed":false}, {"name": "STG", "completed":false}, {"name": "L", "completed":false} ];
	$scope.livres = [ 
	{"name": "TosSVT", "completed":false, "prix": 25, "qte":0}, 
	{"name": "CookMaths", "completed":false, "prix": 15, "qte":0}, 
	{"name": "LearnPhp", "completed":false, "prix": 20, "qte":0} 
	];
	$scope.classes = [  {"name": "Seconde"}, {"name": "Première"}, {"name": "Terminale"} ];

	/**
	* $scope pour les achats
	*
	*/
	//$scope.etats = [{"name" : "Bon", "majoration" : 20}, {"name" : "Moyen", "majoration" : 15}, {"name" : "Médiocre", "majoration" : 10}];
	$scope.achats = [];
		
	$scope.$watch('achats', function(){
		$scope.achats.forEach(function(achat){
			$scope.mt += achat.prix;
		}) // calcul du montant total TTC, pour le moment nombre d'achats 
	}, true)

	$scope.$watch('livres', function(){
		$scope.variable = filterFilter($scope.livres, {completed:true}).length; // calcul du montant total TTC, pour le moment nombre d'achats 
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

	$scope.TransfertLivre = function(){
		$scope.achats = filterFilter($scope.livres, {"completed":true});
		$scope.clicked = false;
	}

	$scope.removeAchat = function(index){
		//alert(index);
		$scope.achats.splice(index,1);

	}

	/*$scope.addLivre = function(newbook){
		$scope.livres.push({
			name : $scope.newbook,
			completed : false
		});
		$scope.newbook = '';
	}*/

	$scope.editTodo = function(todo){
		todo.editing = false;
	}

	$scope.checkAllTodo = function(allchecked){
		$scope.livres.forEach(function(livre){
			livre.completed = allchecked;
		})
	}
	console.log($scope.etats);
	console.log($scope.filieres);
});