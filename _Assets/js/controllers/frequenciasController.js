
app.controller('FrequenciasCtrl',function($scope,$http){
	var frequencias = [];

	$scope.getFrequencias = function(){
		$http.get('http://localhost/cheguei/api/v1/frequencia/getAll.php').then(function(data){
			$scope.frequencias = data.data.frequencias
			console.log(data.data.frequencias);
		});
	};
	$scope.getFrequencias();
});