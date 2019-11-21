<?php 	

require_once 'core.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/includes/fpdf.php');

if($_SESSION['userId'] == -2)
{
	$output = array();
	$assignee = $_SESSION['aname'];
	$sql = "SELECT userid, submitdate, formdata FROM currentapplications WHERE assignee='$assignee' order by formid";
	$result = $forms->query($sql);
	$res = 0;
	if($result->num_rows > 0) {
	while($row = $result->fetch_array()) {
		$sql = "SELECT name from student WHERE rollno = '$row[0]'";
		$result2 = $connect->query($sql);
		$row2 = $result2->fetch_array();
		$row[0] = $row2[0];
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$formdata = json_decode($row[2], true);
		$pdf->Cell(40,10,'The name is '.$formdata['name']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The cost is '.$formdata['cost']);
		$pdf->Ln();
		$pdf->Cell(40,10,'The invoiceno is '.$formdata['invoiceno']);
		$myfile_path = 'php_action/'.$res.$assignee.".pdf";
		$pdf->Output('F',$myfile_path);
		$link = "<a href='$myfile_path'>Click here</a>"; 

		$x = array(
			$row[0],
			$row[1],
			$link
			);

		array_push($output, $x);
		$res = $res + 1;
	 }
	}
	echo json_encode($output);
}
else
{
	$userid = $_SESSION['userId'];
	$sql = "SELECT assignee, submitdate, status, formdata FROM currentapplications WHERE userid='$userid' ORDER BY formid";
	$result = $forms->query($sql);
	$output = array('data' => array());
	$res = 0;

	if($result->num_rows > 0) {

	 $activeBrands = "";

	 while($row = $result->fetch_array()) {
		$brandId = $row[0];

		if($row[2] == 1)
			$activeBrands = "<label class='label label-success'>Available</label>";
		else if($row[2] == 0)
			$activeBrands = "<label class='label label-danger'>Issued</label>";
		else if($row[2] == 2)
			$activeBrands = "<label class='label label-danger'>Under Repair</label>";
		else
			$activeBrands = "<label class='label label-danger'>Lost</label>";

		if($_SESSION['userId']==1)
		{
			$button = '<!-- Single button -->
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeMemberModel" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			  </ul>
			</div>';
		}
		else
		{
			$button = '<!-- Single button -->
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" data-target="#issueBrandModel" onclick="issueBrands('.$brandId.')"> <i class="glyphicon glyphicon-plus"></i> Issue</a></li>
				<li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>      
			  </ul>
			</div>';		
		}

		/*$img = "<img src='assests/images/".strtolower(str_replace(' ','',$row[1])).".jpeg' height='100' width ='100'>";*/

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
			$row[2],
			$link
			);
	 }

	}

	// $hostel->close();

	echo json_encode($output);
}
