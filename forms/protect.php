<?php
$a = dirname(__FILE__).'/../../Gymkhana/php_action/core.php';
require_once $a; 
if(!isset($_SESSION)) { session_start(); }
if(!isset($_SESSION['userId']))
	header('location:../../Gymkhana');
$path = $_SERVER['REQUEST_URI'];
$paths = explode('/', $path);
$lastIndex = count($paths) - 1;
$fileName = $paths[$lastIndex];
$fileName = substr($fileName, 0, strlen($fileName)-4);
$sql = "SELECT userid, assignee from currentapplications WHERE formid = '$fileName'";
$result = $connect->query($sql);
if($result->num_rows!=1)
{
	header('location:../');
}
else
{
	$result = $result->fetch_array();
	$submitter = $result[0];
	$assignee = $result[1];
	if(($submitter == $_SESSION['userId'])||($assignee == $_SESSION['aname']))
	{
		$fileName = $fileName.'.pdf';
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="$fileName"');
		readfile($fileName);
	}
	else
	{
		header('location:../');
	}
}
?>