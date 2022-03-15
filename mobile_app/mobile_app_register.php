<?php
    include 'connect.php';

    $adminkey = $_POST['adminkey'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $id_number = $_POST['id_number'];
    $email = $_POST['email']; 
    $contactNum = $_POST['contactNum'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accountcreation WHERE email = '".$email."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        echo json_encode("Error");
    }else{
        $ran_id = rand(time(), 100000000);
        $encrypt_pass = md5($password);
        $insert = "INSERT INTO accountcreation(unique_id, adminkey, firstname, lastname, email, contactNum, username, password) 
        VALUES('".$ran_id."', '".$adminkey."', '".$firstname."', '".$lastname."', '".$email."', '".$contactNum."', '".$username."', '".$encrypt_pass."')";

        $query = mysqli_query($con, $insert);

        if ($query){
            echo json_encode("Success");
        }
    }

?>