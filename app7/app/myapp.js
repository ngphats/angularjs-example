// application init
var app = angular.module('myApp', ["ngRoute"]);

// config route
app.config(function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl : 'view/home/index.htm'
	})
	.when('/admin', {
		templateUrl : 'view/admin/index.htm',
		controller : 'adminCtrl'
	})
});

// root scope
app.run(function($rootScope) {
	$rootScope.title = 'Application';

	$rootScope.menu = [
		{name: 'Home', link: '#!'},
		{name: 'Admin', link: '#!admin'},
		{name: 'User', link: '#!admin/user'},
		{name: 'Create user', link: '#!admin/user/create'}
	];
});

// administrator controller
app.controller('adminCtrl', function($scope) {
	$scope.ctrl = 'user/index';
});