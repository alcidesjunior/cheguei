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
});