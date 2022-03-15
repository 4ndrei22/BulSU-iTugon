<?php
    session_start();
    include'connect.php';
    $uqinue_id =  $_SESSION['U_unique_id'];
    $sql = "SELECT * FROM accountcreation WHERE unique_id = $uqinue_id";
    if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($con, "UPDATE accountcreation SET status = $status unique_id = $uqinue_id");
        if(mysqli_num_rows($sql2) > 0){
            
        }
        
    }
    session_unset();
            session_destroy();
            header("Location: ../");
    
    
?>