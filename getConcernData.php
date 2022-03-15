<?php
header('Content-Type: application/json');

include 'connect.php';

$sqlQuery = "SELECT subject As Office, COUNT(office_code) AS Office_id FROM ticketinfo GROUP BY subject ORDER BY Office_id DESC LIMIT 5;";
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