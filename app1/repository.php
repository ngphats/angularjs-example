<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['id'])) {
	// database connecting
	$conn = new mysqli("localhost", "root", "mysql", "zendcms");

	$id = $_GET['id'];
	
	if (is_numeric($id)) {
		
		// sql get data by id
		$result = $conn->query("SELECT * FROM `users` WHERE id = $id");
		$data = $result->fetch_array(MYSQLI_ASSOC);
		$dataJson = json_encode($data);
		echo $dataJson;

	} elseif ($id == 'all') {
		
		// sql get all data
		$result = $conn->query("SELECT * FROM `users`");
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$allData['records'][] = $row;
		}

		$dataJson = json_encode($allData);
		echo $dataJson;
	}
}