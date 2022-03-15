<?php
header('Content-Type: application/json');

include 'connect.php';

$sqlQuery = "SELECT status, COUNT(status) AS status_count FROM ticketinfo WHERE status IN ('Assigned','Open','Pending','Resolved','Reopened','Closed') GROUP BY status ORDER BY status;";


$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>