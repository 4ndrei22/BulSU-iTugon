<?php
 include 'connect.php';
 if(!empty($_POST)) {
        $user = $_POST['usernameR'];
        $Fname = $_POST['firstname'];
        $Lname = $_POST['lastname'];
        $ContactNum = $_POST['contact_number'];
        $email = $_POST['email'];
        //$password = password_hash($_POST["passwordR"], PASSWORD_DEFAULT);
        $pass = $_POST['passwordR'];
        //$adminKey = "Staff";
        $accessLvl = $_POST['accessLvl'];
        if ($accessLvl == 1){
                $accessLvl= "Staff";
                //$password = password_hash($_POST["passwordR"], PASSWORD_DEFAULT);
                $sql = "INSERT INTO displayaccess (accessLvl, Firstname, Lastname, Email, Contactnum, Username, Password)
                        VALUES ('$accessLvl','$Fname','$Lname','$email','$ContactNum','$user','$pass')";
                 $sql2 = "INSERT INTO accountcreation (adminKey, Firstname, Lastname, Email, Contactnum, Username, Password)
                          VALUES ('$accessLvl','$Fname','$Lname','$email','$ContactNum','$user','$pass')"; ;
                
                mysqli_query($con,$sql);
                mysqli_query($con,$sql2);
                echo "<meta http-equiv='refresh' content='0'>";
                header('Location: AdminCreation.php');
        }
                
        elseif ($accessLvl == 2){
                $accessLvl= "Super Admin";
                //$password = password_hash($_POST["passwordR"], PASSWORD_DEFAULT);
                $sql = "INSERT INTO displayaccess (accessLvl, Firstname, Lastname, Email, Contactnum, Username, Password)
                        VALUES ('$accessLvl','$Fname','$Lname','$email','$ContactNum','$user','$pass')";
                $sql2 = "INSERT INTO accountcreation (adminKey, Firstname, Lastname, Email, Contactnum, Username, Password)
                          VALUES ('$accessLvl','$Fname','$Lname','$email','$ContactNum','$user','$pass')" ;
                
                mysqli_query($con,$sql);
                mysqli_query($con,$sql2);
                echo "<meta http-equiv='refresh' content='0'>";
                header('Location: AdminCreation.php');
        }
                
        
        //   $password = password_hash($_POST["passwordR"], PASSWORD_DEFAULT);
        //   $sql = "INSERT INTO accountcreation (adminKey, Firstname, Lastname, Email, Contactnum, Username, Password)
        //           VALUES ('$accessLvl','$Fname','$Lname','$email','$ContactNum','$user','$password')";
        //   $sql2 = "INSERT INTO staff_tickets (Staff_name, accessLVL) VALUES ('$Fname','$accessLvl')" ;
          
        //   mysqli_query($con,$sql);
        //   mysqli_query($con,$sql2);
        //   echo "<meta http-equiv='refresh' content='0'>";
        //   header('Location: AdminCreation.php');
            
        
        
      }
 
?>
