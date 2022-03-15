<?php
     include 'connect.php';

 
     $query = $con->query("SELECT * FROM office_code") or die($con->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>