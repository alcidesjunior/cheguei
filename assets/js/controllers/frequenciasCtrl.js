
app.controller('FrequenciasCtrl',function($scope,$http){
	var frequencias = [];

	$scope.getFrequencias = function(){
		$http.get(url+'/cheguei/api/v1/frequencia/getAll.php').then(function(data){
			$scope.frequencias = data.data.frequencias
			console.log(data.data.frequencias);
		});
	};
	$scope.filtrar = function(filtro, search){
		$http.get(url+'/cheguei/api/v1/frequencia/getAll.php?filtro='+filtro+'&search='+search).then(function(data){
			$scope.frequencias = data.data.frequencias
			console.log(data.data.frequencias);
		});
	};
	$scope.getFrequencias();
});