<?php
header('Content-Type: application/json');

include 'connect.php';

$sqlQuery = "SELECT COUNT(date_needed) AS due_tomorrow FROM ticketinfo WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE + INTERVAL 2 DAY)";

$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>