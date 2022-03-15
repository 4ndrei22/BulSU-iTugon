<?php
    session_start();
    include'connect.php';
    $sql = "SELECT * FROM accountcreation WHERE unique_id = '{$_SESSION['U_unique_id']}'";
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $sql2 = mysqli_query($con, "UPDATE accountcreation SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        session_unset();
    session_destroy();
    }
    
    
    header("Location: ../")
?>