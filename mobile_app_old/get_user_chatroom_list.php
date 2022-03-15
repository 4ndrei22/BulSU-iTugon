<?php
     include 'connect.php';

     $ticket_owner = $_POST['ticket_owner'];

     #$query = $db->query("SELECT * FROM messages WHERE outgoing_msg_id = 331003476") or die($db->error);
     $query = $con->query("SELECT *FROM messages WHERE outgoing_msg_id = '$ticket_owner' GROUP BY ticket_id ORDER by timestamp DESC") or die($con->error);
     # $query = $db->query("SELECT * FROM messages LEFT JOIN accountcreation ON accountcreation.unique_id = messages.outgoing_msg_id WHERE outgoing_msg_id = '.$ticket_owner.'") or die($db->error);
     #$query = $db->query("SELECT ticket_id, subject, priority_lvl, status FROM ticketinfo WHERE ticket_owner  = 123123123") or die($db->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>