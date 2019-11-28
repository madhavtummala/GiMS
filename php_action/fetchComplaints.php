<?php 	
require_once 'core.php';
if($_SESSION['userId'] <=2 )
{ 
	$output = array();
	$assignee = $_SESSION['aname'];
	$sql = "SELECT * FROM complaints WHERE status=1";

	$result = $connect->query($sql);
	if($result->num_rows > 0) {

	 while($row = $result->fetch_array()) {

		$brandId = $row[0];

		$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" data-target="#acceptMemberModel" onclick="acceptBrands('.$brandId.')"> <i class="glyphicon glyphicon-ok"></i> Accept</a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeMemberModel" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-remove"></i> Reject</a></li>     
		  </ul>
		</div>';

		$output['data'][] = array(
			$row[1],
			$row[3],
			$row[4],
			$row[5],
			$row[6],
			$button
			);
	 }
	}
	echo json_encode($output);
}
else
{
	$userid = $_SESSION['userId'];
	$sql = "SELECT * FROM complaints";
	$result = $forms->query($sql);
	$output = array('data' => array());
	if($result->num_rows > 0) {
	 $activeBrands = "";
	 while($row = $result->fetch_array()) {
		$brandId = $row[0];

		if($row[2] == 1)
			$activeBrands = "<label class='label label-default'>New</label>";
		else if($row[2] == 0)
			$activeBrands = "<label class='label label-success'>Accepted</label>";
		else if($row[2] == 2)
			$activeBrands = "<label class='label label-danger'>Rejected</label>";
		
		$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" data-target="#resubmitMemberModel" onclick="resubmitBrands('.$brandId.')"> <i class="glyphicon glyphicon-ok"></i> Resubmit</a></li>
			<li><a type="button" data-toggle="modal" data-target="#deleteMemberModel" onclick="deleteBrands('.$brandId.')"> <i class="glyphicon glyphicon-remove"></i> Remove</a></li>
		  </ul>
		</div>';

		$output['data'][] = array(
			$row[1],
			$row[4],
			$row[5],
			$row[6],
			$activeBrands,
			$button
			);
	 }
	}
	echo json_encode($output);
}