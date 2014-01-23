angular.module('app', ['ngAnimate']);
var app = angular.module('GBL', []);

app.directive('ngBlur', function(){
	return function(scope, elem, attrs){
		elem.bind('blur', function(){
			scope.$apply(attrs.ngBlur);
		})
	}
})
app.controller('CtrlLivresDepot', function($scope, filterFilter, $http, $location)
{
	$scope.mt =0;
	$scope.achats = [];
		
	$scope.$watch('achats', function(){
		console.log('oui');
		$scope.mt = 0;
		$scope.achats.forEach(function(achat){
			var tmp = (achat.Row.prize_unit- achat.Row.prize_unit*achat.Row.reducing / 100)*achat.Row.amount;
			if(tmp != null){
				$scope.mt += tmp;
			}
		})
	}, true)

	$scope.$watch('livres', function(){
		if($scope.livres){
			$scope.variable = filterFilter($scope.livres, {completed:true}).length; 
		}
	}, true)

	$scope.VerifBook = function(){

		}

	var anciens;
	$scope.TransfertLivre = function(){
		$tmp = angular.copy(filterFilter($scope.livres, {"completed":true}));
		console.log('affichage');
		console.log($scope.etats);
		for(i in $tmp){
			console.log($tmp[i]);

			$t = {Row: {
					transaction_id : $scope.transaction_id,
					book_id: $tmp[i].Book.id,
					name_book: $tmp[i].Book.name,
					name_subject: $tmp[i].Subject.name,
					Condition: $scope.etats[0],
					reducing: $scope.etats[0].Condition.reducing,
					name_condition: $scope.etats[0].Condition.name,
					prize_total: $scope.calculTotal($tmp[i].Book.prize, $scope.etats[0].Condition.reducing, 1),
					amount: 1,
					prize_unit : $tmp[i].Book.prize
					}}

			$scope.achats.push($t);		
		}
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
				    });			
	}

	$scope.updateBooks = function(){
		$http.get($scope.urlGetBooks+'/'+$scope.choixClasse.Grade.id).success(function(response) {
						$scope.livres = response;
				    });			

	}

	$scope.duplicateAchat = function(index){
		$scope.achats.splice(index+1, 0, angular.copy($scope.achats[index]));
	}

	$scope.editTodo = function(todo){
		todo.editing = false;
	}

	$scope.checkAllTodo = function(allchecked){
		$scope.livres.forEach(function(livre){
			livre.completed = allchecked;
		})
	}
	

	/**
	*
	*/
	$scope.calculTotal = function(prize_unit, reducing, amount){

		return (prize_unit- prize_unit*reducing/100)* amount;
	}

	/**
	*	Recalcul du total si modification de la quantité ou de la réduction
	*/
	$scope.changeRow = function(index){
			$scope.achats[index].Row.prize_total = $scope.calculTotal($scope.achats[index].Row.prize_unit,$scope.achats[index].Row.reducing,$scope.achats[index].Row.amount);
	}

	/**
	*	Appelé au changement de condition dans le menu déroulan
	*	Permet de mettre à jour le champs de réduction
	*/
	$scope.updateCondition = function(index){
		$scope.achats[index].Row.reducing = $scope.achats[index].Row.Condition.Condition.reducing;
		$scope.achats[index].Row.name_condition = $scope.achats[index].Row.Condition.Condition.name;
		$scope.changeRow(index);
	}


});