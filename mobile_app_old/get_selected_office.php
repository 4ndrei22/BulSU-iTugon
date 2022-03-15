<?php
     include 'connect.php';
     ini_set('display_errors', 'Off');

     $id = $_POST['id'];
 
     $result = "SELECT office from office_code WHERE id = '$id'";
    # $result = "SELECT office from office_code WHERE id = 1087";
    # $result = $db->query("SELECT office from office_code WHERE id = 1087") or die($db->error);
     
     $query = mysqli_query($con, $result) or die($con->error);

     if(mysqli_num_rows($query)>0){
         foreach($query as $row){
             echo json_encode($row['office']); 
         }
     }
     else
     echo 'No Data';
     #echo $row;

    # $num_rows = mysqli_num_rows($result);
    #echo $row['office'];
     #echo $result;
    

?>