
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
			$scope.frequencias = data.data.frequencias;
			console.log(data.data.frequencias);
		});
	};
	$scope.dataInicio = "";
	$scope.dataFim = "";
	$scope.chart_div = {};
	$scope.chart_div.type = "ColumnChart";
	$scope.linhas = new Array();
	$scope.chart_div.data = {};
	$scope.filtroRelatorio = function(dataInicio,dataFim){
		$scope.linhas = [];
		    
		$http.get(url+'/cheguei/api/v1/frequencia/relatorio.php?dataInicio='+dataInicio+'&dataFim='+dataFim).then(function(result){
			result.data.forEach(function(current){
				$scope.linhas.push({c:[{v: current.nome},{v: current.presencas[0].presenca/2}]});
			});

			$scope.chart_div.data = {"cols": [
		        {id: "t", label: "Topping", type: "string"},
		        {id: "s", label: "Presenças", type: "number"}
		    ], "rows": $scope.linhas};
		    $scope.chart_div.options = {
		        'title': 'Presenças entre '+dataInicio+' e '+dataFim
		    };
		},function(error){
			console.log(error.data);
		});
	}
	$scope.getFrequencias();
});