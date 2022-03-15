<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['U_unique_id'];
    $sql = "SELECT * FROM ticketinfo WHERE NOT ticket_id = '$outgoing_id' ORDER BY timestamp DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "<p class='text-center text-black mt-5 p-4 fs-5 fw-600'>No Ticket Available.</>";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "ticket_data.php";
    }
    echo $output;
?>