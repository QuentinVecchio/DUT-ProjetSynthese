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
		
	/*$scope.$watch('achats', function(){
		console.log('oui');
		$scope.mt = 0;
		$scope.achats.forEach(function(achat){
			var tmp = (achat.book.prize- achat.book.prize*achat.book.etat.conditions.reducing / 100)*achat.book.qte;
			if(tmp != null){
				$scope.mt += tmp;
			}
		})
	}, true)*/

	$scope.$watch('livres', function(){
		$scope.variable = filterFilter($scope.livres, {completed:true}).length; 
	}, true)

	/*if($location.path() == '')
		{
		 $location.path('/')
		}
	$scope.location = $location;
	$scope.$watch('location.path()', function(path)
	{
		$scope.statusFilter =
			(path == '/active') ? {completed : false} : null;
			(path == '/done') ? {completed : true} : null;
	});*/

	$scope.VerifBook = function(){
		var tmp = $scope.achats;
		var tmp2 = $scope.achats;
		var nbook ;
			for(i in tmp){
				nbook = 0;
				//alert($tmp[i].book.etat.conditions.name);
				for(j in tmp2){
					if(tmp[i].book.name == tmp2[j].book.name && i != j){
						//alert(tmp[i].book.name + i +' = ' + tmp2[j].book.name + j );
						if(nbook == 1){
							alert('Vous avez deux fois le livre' + tmp[i].book.name);
							break;
						}
						nbook ++;
						//break;
					}
				}
					alert(nbook);
			}
		}

	var anciens;
	$scope.TransfertLivre = function(){
		$tmp = angular.copy(filterFilter($scope.livres, {"completed":true}));
		console.log('affichage');
		for(i in $tmp){
			console.log($tmp[i]);

			$t = {Row: {
					transaction_id : $scope.transaction_id,
					book_id: $tmp[i].book.id,
					name_book: $tmp[i].book.name,
					name_subject: $tmp[i].Subject.name,
					Condition: $scope.etats[0],
					reducing: $scope.etats[0].Condition.reducing,
					amount: 1,
					prize_unit : $tmp[i].book.prize
					//prize_total: ($tmp[i].book.prize - $tmp[i].book.prize*$tmp[i].book.reducing/100)*amount;
					}}

			$scope.achats.push($t);		
		}
			//$scope.achat.Row.prize_total = ($scope.achat.Row.prize_unit- $scope.achat.Row.prize_unit*  $scope.achat.Row.reducing / 100)*$scope.achat.Row.amount;

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
		$http.get($scope.urlGetGrades+'/'+$scope.choixFiliere.Sector.id).success(function(response) {
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

		$scope.achats.splice(index+1, 0, angular.copy($scope.achats[index]));

		/*var original = $scope.achats[index];
		console.log($scope.achats);
		var tmp = {
			book: { id: original.book.id+1, name: original.book.name, prize: original.book.prize, etat: { condition:{id:'', name: "", reducing:''}}, qte: original.book.qte},
			Subject: {name: original.Subject.name},
			completed : true
			};*/
	}

	$scope.editTodo = function(todo){
		todo.editing = false;
	}

	$scope.checkAllTodo = function(allchecked){
		$scope.livres.forEach(function(livre){
			livre.completed = !allchecked;
		})
	}
	
	/**
	*	Recalcul du total si modification de la quantité ou de la réduction
	*/
	$scope.changeRow = function(index){
		$scope.achats[index].Row.prize_total = ($scope.achats[index].Row.prize_unit- $scope.achats[index].Row.prize_unit*  $scope.achats[index].Row.reducing / 100)*$scope.achats[index].Row.amount;

	}

	/**
	*	Appelé au changement de condition dans le menu déroulan
	*	Permet de mettre à jour le champs de réduction
	*/
	$scope.updateCondition = function(index){
		$scope.achats[index].Row.reducing = $scope.achats[index].Row.Condition.Condition.reducing;
		$scope.achats[index].Row.name_condition = $scope.achats[index].Row.Condition.Condition.name;
	}


});