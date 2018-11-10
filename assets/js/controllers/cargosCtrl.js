app.controller('CargosCtrl',function($scope,$http,$routeParams){
	$scope.getCargos = function(){
		$http.get(url+'/cheguei/api/v1/cargos/getAll.php').then(function(data){
			$scope.cargos = data.data;
			console.log($scope.cargos[0].cargo);
		});
	};
	$scope.cadastrar = function(){
		$http.post(url+'/cheguei/api/v1/cargos/create.php',$scope.cargo).then(function(response){
			console.log(response.data);
		});
	};
	$scope.getCargoByID = function(id){
		$http.get(url+'/cheguei/api/v1/cargos/show.php?cargo_id='+id).then(function(data){
			$scope.cargo = data.data;
		});
	};	
	$scope.atualizar = function(){
		console.log($scope.cargo);
		$http.post(url+'/cheguei/api/v1/cargos/update.php',$scope.cargo).then(function(response){
			console.log(response.data);
		});
	}
	$scope.getCargos();
	if($routeParams.cargo_id != null ){
		$scope.getCargoByID($routeParams.cargo_id);
	}
});