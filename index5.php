<?php 
$data               = file_get_contents("php://input");
$dataJsonDecode     = json_decode($data, true);
echo "Hello, ".$dataJsonDecode['name'];

//
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");

$result = $conn->query("SELECT CompanyName, City, Country FROM Customers");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Name":"'  . $rs["CompanyName"] . '",';
    $outp .= '"City":"'   . $rs["City"]        . '",';
    $outp .= '"Country":"'. $rs["Country"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);


// like this
$members = [
    {name:'Jani',country:'Norway'},
    {name:'Hege',country:'Sweden'},
    {name:'Kai',country:'Denmark'}
];

/*
switch ($_GET['id']) {
	case 'admin':
		echo "Hello Admin!";
		break;
	case 'member':
		echo "Hello Member!";
		break;
	default:
		echo "Hello Guest";
		break;
}
*/