<!DOCTYPE html>
<html>
<head>
	<title>Application 1</title>
	<script type="text/javascript" src="../angular.min.js"></script>
</head>
<body ng-app="myApp">
	<div ng-controller="myCtrl">
	
		<?php 
		/**
			TODO:
			- First create user list
			- Second, when click on user, will show user infomation.
		 */

		$conn = new mysqli("localhost", "root", "mysql", "zendcms");
		$result = $conn->query("SELECT id, username FROM users");
		?>
		<a ng-click="getInfo('all')" href="javascript:void(0)">All User</a> <br>

		<?php while($row = $result->fetch_array(MYSQLI_ASSOC)) : ?>
			<a ng-click="getInfo(<?= $row['id'] ?>)" href="javascript:void(0)"><?= $row['username'] ?></a> <br>
		<?php endwhile ?>

		<table ng-show="dataUser != null">
			<tr>
				<td>ID</td>
				<td>Username</td>
				<td>Phone</td>
				<td>Email</td>
			</tr>
			<tr>
				<td>{{dataUser.id}}</td>
				<td>{{dataUser.username}}</td>
				<td>{{dataUser.phone}}</td>
				<td>{{dataUser.Email}}</td>
			</tr>
		</table>

		<table ng-show="allUser != null && dataUser == null">
			<tr>
				<td>ID</td>
				<td>Username</td>
				<td>Phone</td>
				<td>Email</td>
			</tr>
			<tr ng-repeat="data in allUser">
				<td>{{data.id}}</td>
				<td>{{data.username}}</td>
				<td>{{data.phone}}</td>
				<td>{{data.Email}}</td>
			</tr>		
		</table>

		<p id='name'></p>

	</div>


<script type="text/javascript">
	angular.module('myApp',[]).controller('myCtrl', function($scope, $http) {
		$scope.getInfo = function(idUser) {
			if (idUser == 'all') {
				$http.get("repository.php?id="+idUser).then(function(response) {
					$scope.allUser = response.data.records;
				});	
			} else {
				$http.get("repository.php?id="+idUser).then(function(response) {
					$scope.dataUser = response.data;
				});			
			}
		}
	});
</script>

</body>
</html>