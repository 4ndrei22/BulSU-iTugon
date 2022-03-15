<?php

include "connect.php"; // Using database connection file here

$sql = "SELECT * FROM accountcreation ";
$result = $mysqli->query($sql);
$mysqli->close(); 
?>