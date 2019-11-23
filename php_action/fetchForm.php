<?php 	

require_once 'core.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/includes/fpdf.php');

//echo __ROOT__.'/includes/fpdf.php';

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
		$new_assignee = str_replace(' ', '', $assignee);
		$formdata = json_decode($row[2], true);
		$link = "php_action/".$res.$new_assignee.".pdf";
		$link = "<a href=$link target='_blank'>Click here</a>";

		$initial="";
		foreach ($formdata as $data)
		{
			$initial = $initial.$data.',';
		}
		$initial = $initial.','.$res.$new_assignee.'.pdf';

		$command = "python C://xampp//htdocs//Gymkhana//pdf.py ".$initial;
		exec("$command", $output); 

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

	 while($row = $result->fetch_array()) {

		$formdata = json_decode($row[3], true);
		$link = "php_action/".$res.$userid.".pdf";
		$link = "<a href=$link target='_blank'>Click here</a>";

		$initial="";
		foreach ($formdata as $data)
		{
			$initial = $initial.$data.',';
		}
		$initial = $initial.','.$res.$userid.'.pdf';

		$command = "python ".$base."/pdf.py \"".$initial."\"";
		exec("$command", $output);
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
