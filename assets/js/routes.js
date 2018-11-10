app.config(function($routeProvider){
	$routeProvider
	.when('/',{
		templateUrl:'View/frequencias/frequencias.html',
		controller: 'FrequenciasCtrl'
	})
	.when('/funcionarios',{
		templateUrl: 'View/funcionarios/funcionarios.html',
		controller: 'FuncionariosCtrl'
	})
	.when('/detailsFuncionario/:funcionario_id',{
		templateUrl: 'View/funcionarios/detailsFuncionario.html',
		controller: 'FuncionariosCtrl'
	})
	.when('/novoFuncionario',{
		templateUrl: 'View/funcionarios/novoFuncionario.html',
		controller: 'FuncionariosCtrl'
	})
	.when('/cargos',{
		templateUrl: 'View/cargos/cargos.html',
		controller: 'CargosCtrl'
	})
	.when('/novoCargo',{
		templateUrl: 'View/cargos/novoCargo.html',
		controller: 'CargosCtrl'
	})
	.when('/detailsCargo/:cargo_id',{
		templateUrl: 'View/cargos/detailsCargo.html',
		controller: 'CargosCtrl'
	})
});