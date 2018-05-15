<?php 
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		if (empty($_REQUEST)) {
			$data               = file_get_contents("php://input");
			$_POST     = json_decode($data, true);
		}
		echo "Hello, " . $_POST['name'];
		break;
	case 'GET':
		echo 'GET';
		break;
	case 'PUT':
		echo 'PUT';
		break;
	case 'DELETE':
		echo 'DELETE';
		break;
	default:
		echo 'Any';
		break;
}