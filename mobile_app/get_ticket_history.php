<?php
     include 'connect.php';

     $ticket_id = $_POST['ticket_id'];
 
     $query = $con->query("SELECT updates, timestamp FROM ticket_history WHERE ticket_id  = '$ticket_id'") or die($con->error);
     #$query = $con->query("SELECT ticket_id, subject, priority_lvl, status FROM ticketinfo WHERE ticket_owner  = 123123123") or die($con->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    
?>