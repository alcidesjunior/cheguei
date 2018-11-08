
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
function checkParameter(name, url){
	if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
    return results;
}
app.controller('FuncionariosCtrl',function($scope,$http,$routeParams){
	$scope.getFuncionarios = function(){
		$http.get('http://localhost/cheguei/api/v1/funcionarios/getAll.php').then(function(data){
			$scope.funcionarios = data.data.funcionarios
		});
	};
	$scope.getFuncionarioById = function(id){
		$http.get('http://localhost/cheguei/api/v1/funcionarios/show.php?funcionario_id='+id).then(function(data){
			$scope.funcionario = data.data;
			$http.get('http://localhost/cheguei/api/v1/cargos/getAll.php').then(function(e){
				$scope.cargos = e.data;
			});
		});
	}
	$scope.removerCargo = function(id){
		if(id==undefined){
			console.log('id null');
		}else{
			if(confirm("Deseja excluir cargo?")){
				var index = $scope.funcionario.dispositivos.indexOf(id);
				console.log(index);
				$scope.funcionario.dispositivos.splice(index,1);
			}
		}
	};
	$scope.novoDispositivo = function(){
		$scope.funcionario.dispositivos.push({'id':'-1','mac_address':$scope.inputNovoDevice});
	};
	$scope.atualizar=function(){
		console.log($scope.funcionario.dispositivos);
		$http.post('http://localhost/cheguei/api/v1/funcionarios/update.php',$scope.funcionario).then(function(response){
			console.log(response.data);
		});
	};
	$scope.getFuncionarios();
	if($routeParams.funcionario_id != null ){
		
		$scope.getFuncionarioById($routeParams.funcionario_id);
	}
	
});
