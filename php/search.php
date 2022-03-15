<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['U_unique_id'];
    $searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);

    $sql1 = "SELECT ticket_id FROM ticketinfo ";
    $output = "";
    $query1 = mysqli_query($con, $sql1);
    if(mysqli_num_rows($query1) > 0){
        $row = mysqli_fetch_assoc($query1);
        $sql="SELECT * FROM ticketinfo WHERE ticket_id = {$row['ticket_id']}  AND (ticket_id LIKE '%{$searchTerm}%' OR ticket_owner LIKE '%{$searchTerm}%' OR subject LIKE '%{$searchTerm}%' OR office_code LIKE '%{$searchTerm}%' )";
        $query = mysqli_query($con,$sql);
        if(mysqli_num_rows($query) > 0){
            include_once "data.php";
        }else{
            $output .= '<p class="text-muted fw-600 text-center">No user found</p>';
        }
        
    }else{
        $output .= '<p class="text-muted fw-600 text-center">No user found</p>';
        
    }
    echo $output;
?>