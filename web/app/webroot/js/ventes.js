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
	/*$scope.livres = [ 
	{"name": "TosSVT", "completed":false, "prix": 25, "qte":0}, 
	{"name": "CookMaths", "completed":false, "prix": 15, "qte":0}, 
	{"name": "LearnPhp", "completed":false, "prix": 20, "qte":0} 
	];*/
	//$scope.classes = [  {"name": "Seconde"}, {"name": "Première"}, {"name": "Terminale"} ];

	/**
	* $scope pour les achats
	*
	*/
	//$scope.etats = [{"name" : "Bon", "majoration" : 20}, {"name" : "Moyen", "majoration" : 15}, {"name" : "Médiocre", "majoration" : 10}];
	$scope.achats = [];
		
	$scope.$watch('achats', function(){
		console.log('oui');
		$scope.mt = 0;
		$scope.achats.forEach(function(achat){
			var tmp = (achat.book.prize- achat.book.prize*achat.book.etat.conditions.reducing / 100)*achat.book.qte;
			if(tmp != null){
				$scope.mt += tmp;
			}
		}) // calcul du montant total TTC, pour le moment nombre d'achats 
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


	/**
	Le problème étant qu'il copie bien le livres mais qu'en fait il rajoute une profondeur de tableau du 
	coup l'affichge plante, je conseille d'utiliser le pulgin AngularJS Batarang sous Chrome.
	Enjoy **/
	var anciens;

	$scope.TransfertLivre = function(){

		$tmp = angular.copy(filterFilter($scope.livres, {"completed":true}));
		for(i in $tmp){
			$scope.achats.push($tmp[i]);			
		}
		
		$scope.clicked = false;

		/*$tmp = angular.copy(filterFilter($scope.livres, {"completed":true})); 
		$scope.achats.push($tmp);
		$scope.clicked = false;
*/
		/*$scope.achats = filterFilter($scope.livres, {"completed":true}); 
		if(anciens != ""){ // si il existe d'anciens livres d'autres classes ou filières
			//$scope.achats.push($scope.anciens);
			$scope.achats.splice(10, 0, anciens); // on met le ou les anciens au début de la liste (index 0)
			$scope.clicked = false;
		}
		else if(anciens == "")
			$scope.clicked = false;*/
	}

	$scope.saveAchats = function(){
		$scope.clicked = true;
		if($scope.variable == null)
			$scope.variable = 0;
		//$scope.anciens = $scope.achats;
		//$scope.anciens = angular.copy($scope.achats);
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
		//alert('Valeur originale = '+original.Subject.name+original.book.name+original.book.qte+original.book.prize);
		var tmp = {
			book: { id: original.book.id+1, name: original.book.name, prize: original.book.prize, etat: { condition:{id:'', name: "", reducing:''}}, qte: original.book.qte},
			Subject: {name: original.Subject.name},
			completed : true
			};
		$scope.achats.splice(index+1, 0, tmp);
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
			livre.completed = !allchecked;
		})
	}
	
});