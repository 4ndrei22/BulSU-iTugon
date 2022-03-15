<?php
     include 'connect.php';

     $email = $_POST['email'];
     $password = $_POST['password'];
 
     $query = $con->query("SELECT username, firstname, lastname, email, unique_id FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'") or die($db->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>