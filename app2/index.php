<?php 
$data = [
	'id' => 1,
	'title' => 'Pin laptop T7200',
	'price' => '2000',
	'colors' => ['red','blue','green'],
	'options' => [
		'4' => [
			'cell' => '4 cell',
			'price' => 400
		],
		'6' => [
			'cell' => '6 cell',
			'price' => 600
		],
		'9' => [
			'cell' => '9 cell',
			'price' => 900
		]	
	],
	/*
	'cell' => [
		'4 cell' => 400,
		'6 cell' => 600,
		'9 cell' => 900,
	],
	*/
];

// change array to json -> options
foreach($data['options'] as $k => $v) {
	$opt['options'][] = $v;
}
// options json
$options = json_encode($opt);

/*
// change array to json -> cell
$cellArr['cell'][] = $data['cell']; 

// cell json
$cellJson = json_encode($cellArr);
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Application 2</title>
	<script type="text/javascript" src="../angular.min.js"></script>
	<style type="text/css">
		.cellnumber {
			display: flex;
			flex-wrap: wrap;
			padding: 0
		}
		.cellnumber > li {
			list-style: none;
			background-color: #ddd;
			width: 40px;
			padding: 4px 8px;
			margin: 2px;
		}
	</style>
</head>
<body ng-app="myApp">

	<div ng-controller="myCtrl" ng-init="qty='1';price='<?= $data['price'] ?>'">

		<main>
			<article>
				<h2><?= $data['title'] ?></h2>
				<p>Price: <span ng-bind="price"></span></p>
				<p>Qty: 
					<button ng-click="raiseQty()">+</button>
					<input size="2" type="text" name="qty" ng-model='qty'>
					<button ng-click="reduceQty()">-</button>
				</p>
				<p>Cell number:
					<!--<ul class="cellnumber">
						<li ng-repeat="item in productOptions">{{item.cell}} cell</li>
					</ul>-->
					<select ng-change="chooseCell(selCellNumber.price)" ng-model="selCellNumber" ng-options="item.cell for item in productOptions"></select>
				</p>

			</article>
		</main>
	</div>

	<script>
	angular.module('myApp',[]).controller('myCtrl', function($scope) {
		// convert options json to obj
		var objProductOptions = JSON.parse('<?= $options ?>');
		$scope.productOptions = objProductOptions.options;
		$scope.selCellNumber = objProductOptions.options[0];

		/*
		// convert cell json to obj
		var objCell = JSON.parse('<?= $cellJson ?>');
		// bind obj into variable
		$scope.valCell = objCell.cell[0];
		$scope.selCellNumber = objCell.cell[0]['4 cell'];
		*/

		console.log(objProductOptions.options);

		$scope.chooseCell = function(item) {
			$scope.price = <?= $data['price'] ?> + item;
			console.log(item);
		}
		
		$scope.raiseQty = function() {
			$scope.qty++;
		}

		$scope.reduceQty = function() {
			if ($scope.qty <= 1) {
				$scope.qty = 1;
			} else {
				$scope.qty = $scope.qty - 1;
			}
		}

	});
	</script>

</body>
</html>