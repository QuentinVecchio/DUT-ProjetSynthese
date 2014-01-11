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
			//alert(achat.Row.prize_unit);
			var tmp = (achat.Row.prize_unit- achat.Row.prize_unit*achat.Row.reducing / 100)*achat.Row.amount;
			if(tmp != null){
				$scope.mt += tmp;
			}
		})
	}, true)

	$scope.$watch('livres', function(){
		if($scope.livres != null){
			$scope.variable = 0; 
			for(i in $scope.livres){
				if($scope.livres[i].completed){
					$scope.variable += 1;
				}
			}
		}
	}, true);

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

		/**
		*	Matthieu:
		*		- Pourquoi ne pas utiliser un filterFilter avec comme paramètre book_id : xxx ?
		*/
		/*var tmp = $scope.achats;
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
			}*/
		}

	$scope.TransfertLivre = function(){
		$tmp = angular.copy(filterFilter($scope.livres, {"completed":true}));

		$selectedAchat = [];
		// Parcours des livres, construction des lignes a soumettre si selectionné
		for(i in $tmp){
			if($scope.livres[i].completed){
				$total = $scope.calculTotal($tmp[i].Book.prize, $tmp[i].ConditionList[0].Condition.reducing, 1);
				$t = {Row: {
					transaction_id : $scope.transaction_id,
					book_id: $tmp[i].Book.id,
					name_book: $tmp[i].Book.name,
					name_subject: $tmp[i].Subject.name,
					reducing: $tmp[i].ConditionList[0].Condition.reducing,
					name_condition: $tmp[i].ConditionList[0].Condition.name,
					condition_id: $tmp[i].ConditionList[0].Condition.id,
					prize_total: $total,
					amount: 1,
					prize_unit : $tmp[i].Book.prize,
					}}
				$selectedAchat.push($t);		
			}
		}

		// On poste les livres
		$http.post($scope.urlAddRow, $selectedAchat).success(function(response){
			// $scope.errors a traiter encore (message d'erreur)
			$scope.achats = response.rows;
		});
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
		$http.get($scope.urlDeleteRow+'/'+$scope.achats[index].Row.id).success(function(response) {				      	
			if(response > 0){
				
				$scope.achats.splice(index,1);
			}else{
				alert('Erreur');
			}
	    });	
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
		for(i in $scope.livres){
			$scope.livres[i].completed = !allchecked;
		}
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
		$data = angular.copy($scope.achats[index].Row);

		$data.condition_id = $data.Condition.Condition.id;
		$data.ConditionList = undefined;
		$data.Condition = undefined;

		console.log('data');
		console.log($data);
		$http.post($scope.urlUpdateRow, $data).success(function(response){
					console.log('update');
			      	console.log(response);
			      	if(response.errors.length == 0){
			      		$scope.achats.splice(index, 1, response.rows[0]);
			      	}else{
			      		console.log('Erreur');
			      	}
		});
	}

	/**
	*	Appelé au changement de condition dans le menu déroulan
	*	Permet de mettre à jour le champs de réduction
	*/
	$scope.updateCondition = function(index){
		console.log('update');
		$scope.achats[index].Row.reducing = $scope.achats[index].Row.Condition.Condition.reducing;
		$scope.achats[index].Row.name_condition = $scope.achats[index].Row.Condition.Condition.name;
		$scope.changeRow(index);
	}


});