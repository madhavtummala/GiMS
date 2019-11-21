<?php 	

require_once 'core.php';
require('../includes/fpdf.php');

$userid = $_SESSION['userId'];
$sql = "SELECT assignee, submitdate, status, formdata FROM currentapplications WHERE userid='$userid' ORDER BY formid";
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
	$pdf->Output('F',$res.".pdf");
	$link = "php_action/".$res.".pdf";
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
