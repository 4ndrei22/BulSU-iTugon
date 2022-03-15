<?php
     include 'connect.php';

 
     $result = $con->query("SELECT * from ticketinfo") or die($con->error);
     
     $num_rows = mysqli_num_rows($result);

     echo json_encode($num_rows);
     #echo $num_rows;
    

?>