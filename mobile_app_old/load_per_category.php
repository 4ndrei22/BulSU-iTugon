<?php
     include 'connect.php';

     $title_id = $_POST['title_id'];
 
     $query = $con->query("SELECT question, answer FROM knowledgebase WHERE title_id = '{$title_id}' ORDER BY id") or die($con->error);
     #$query = $con->query("SELECT ticket_id, subject, priority_lvl, status FROM ticketinfo WHERE ticket_owner  = 123123123") or die($con->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>