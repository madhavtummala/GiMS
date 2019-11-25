<?php 	

require_once 'core.php';

$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_SESSION['userId'];

$sql = "DELETE FROM calevents WHERE name = '$a' AND start = '$b' AND end = '$c' AND creator = '$d'";
if($connect->query($sql)) {
    $valid['success'] = true;
    $valid['messages'] = "Successfully Updated";
	$sql = "SELECT * FROM calevents";
	$result = $connect->query($sql);
	$output = array();
	while($row = $result->fetch_array())
	{
		$temp = array($row[0],$row[1],$row[2]);
		array_push($output, $temp);
	}
	$valid['output'] = json_encode($output);
} else {
    $valid['success'] = false;
    $valid['messages'] = "Error while Updating";
	$valid['output'] = '';
}
/*$valid['success'] = true;
$valid['messages'] = "Successfully Updated". $_POST['a'];*/

echo json_encode($valid);
?>