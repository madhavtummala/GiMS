<?php 	

require_once 'core.php';

$userid = $_SESSION['userId'];
$sql = "SELECT * FROM assignee";
/*echo $sql;
if ($forms->query($sql) === TRUE)
{
	echo "Umm";
}*/
$result = $forms->query($sql);
$output = array('data' => array());
$res = 0;

if($result->num_rows > 0) {

 $activeBrands = "";

 while($row = $result->fetch_array()) {
 	if($_SESSION['userId']==1)
 	{
	 	$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$row[1].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeMemberModel" onclick="removeBrands('.$row[1].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';
	}
 	$output['data'][] = array(
 		$row[1],
 		$row[0],
		$button
 		);
 }

}

// $hostel->close();
//var_dump($output);
echo json_encode($output);
