<?php
header('Content-Type: application/json');

include 'connect.php';

$sqlQuery = "SELECT COUNT(MONTHNAME (date_created)) AS monthCount FROM ticketinfo GROUP BY MONTH(date_created)";
$result = mysqli_query($con,$sqlQuery);
if(mysqli_num_rows($result) > 0){
    $fetch = mysqli_fetch_assoc($result);
    
}
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($con);

echo json_encode($data);
?>