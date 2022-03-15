<?php
     include 'connect.php';

     $ticket_owner = $_POST['ticket_owner'];
     $status = $_POST['status'];
 
     $query = $con->query("SELECT ticket_id, subject, priority_lvl, status, date_created FROM ticketinfo WHERE ticket_owner  = '$ticket_owner' ORDER BY date_created DESC") or die($con->error);
     #$query = $con->query("SELECT ticket_id, subject, priority_lvl, status FROM ticketinfo WHERE ticket_owner  = 123123123") or die($con->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>