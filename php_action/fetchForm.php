<?php 	
require_once 'core.php';
if($_SESSION['userId'] == -2)
{ 
	$output = array();
	$assignee = $_SESSION['aname'];
	$sql = "SELECT userid, submitdate, formdata, formid FROM currentapplications WHERE assignee='$assignee' AND status=0 order by formid";
	$result = $forms->query($sql);
	if($result->num_rows > 0) {
	 $activeBrands = "";
	 while($row = $result->fetch_array()) {
		$brandId = $row[3];
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
		$link = "forms/".$brandId.".pdf";
		$link = "<a href=$link>Click here</a>";
		$output['data'][] = array(
			$row[0],
			$row[1],
			$link,
			$button
			);
	 }
	}
	echo json_encode($output);
}
else
{
	$userid = $_SESSION['userId'];
	$sql = "SELECT assignee, submitdate, status, formdata, formid FROM currentapplications WHERE userid='$userid' ORDER BY formid";
	$result = $forms->query($sql);
	$output = array('data' => array());
	if($result->num_rows > 0) {
	 $activeBrands = "";
	 while($row = $result->fetch_array()) {
		$brandId = $row[4];
		if($row[2] == 0)
			$activeBrands = "<label class='label label-default'>New</label>";
		else if($row[2] == 1)
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
		$link = "forms/".$brandId.".pdf";
		$link = "<a href=$link>Click here</a>";
		$output['data'][] = array(
			$row[0],
			$row[1],
			$activeBrands,
			$link,
			$button
			);
	 }
	}
	echo json_encode($output);
}