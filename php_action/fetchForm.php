<?php 	

require_once 'core.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/includes/fpdf.php');

//echo __ROOT__.'/includes/fpdf.php';

if($_SESSION['userId'] == -2)
{
	$output = array();
	$assignee = $_SESSION['aname'];
	$sql = "SELECT userid, submitdate, formdata, formid FROM currentapplications WHERE assignee='$assignee' AND status=0 order by formid";
	$result = $forms->query($sql);
	$res = 0;
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

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$formdata = json_decode($row[2], true);
		$pdf->Cell(40,10,'The name is '.$formdata['name']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The cost is '.$formdata['cost']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The invoiceno is '.$formdata['invoiceno']);
		$pdf->Output('F',$res.$userid.".pdf");
		$link = "php_action/".$res.$userid.".pdf";
		$link = "<a href=$link>Click here</a>";
		$res = $res + 1;

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
	$res = 0;

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

		/*$img = "<img src='assests/images/".strtolower(str_replace(' ','',$row[1])).".jpeg' height='100' width ='100'>";*/

		//echo "ok";
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$formdata = json_decode($row[3], true);
		$pdf->Cell(40,10,'The name is '.$formdata['name']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The cost is '.$formdata['cost']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The invoiceno is '.$formdata['invoiceno']);
		$pdf->Output('F',$res.$userid.".pdf");
		$link = "php_action/".$res.$userid.".pdf";
		$link = "<a href=$link>Click here</a>";
		$res = $res + 1;

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
