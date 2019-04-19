<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT eid, name, dateofpurchase, status FROM equipment WHERE eid = $brandId";
$result = $hostel->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$hostel->close();

echo json_encode($row);