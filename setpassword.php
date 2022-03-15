<?php 
  session_start();
?>
<?php
	$msg = "";
  
	if (isset($_POST['submit'])) {
		include 'connect.php';
        $password = $_POST['password'];
        $con_password = $_POST['con_password'];
        if(!empty($password) && !empty($con_password)){
            if($password == $con_password){
                $encrypt_pass = md5($password);
                $email = $_SESSION['email'];
                $sql = mysqli_query($con,"UPDATE `accountcreation` SET password = '$encrypt_pass' WHERE email = '$email'");
                if(mysqli_num_rows($sql) < 0){
                    $msg = " unable changed";
                }else{
                    $msg = "Password successfully changed";
                    $email = $_SESSION['email'];
                    $select = mysqli_query($con,"SELECT * FROM accountcreation WHERE email='$email' AND status ='Enable'");
                    
                    if(mysqli_num_rows($select) > 0){
                        $row = mysqli_fetch_assoc($select);
                        $adminkey = $row['adminkey'];
                        if($row['adminkey'] == 1){
                             header("location: Dashboard(staff)");
                               $_SESSION['U_unique_id'] = $row['unique_id'];
                        }elseif($row['adminkey'] == 2){
                             header("location: Dashboard(super)");
                             $_SESSION['U_unique_id'] = $row['unique_id'];
                        }
                    }else{
                        
                        $msg = "$email jkhkjhkj";
                    }
                    
                    
                    //header('refresh: 1, url = setpassword');
                }
            }else{
              $msg = "Password didn't match";
              header('refresh: 1, url = setpassword');
            }
        }else{
          $msg = "All input fields are required!";
          header('refresh: 1, url = setpassword');
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="BulSU.png">
  <title>BulSU iTugon</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./CSS Files/Login.css">
  <link rel="stylesheet" href="./CSS Files/Staff_Dashboard.css">
  
  

</head>
<body>

    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 vh-100 pt-5 mt-5 d-none d-lg-block">
        <div class=" pb-7">
          <img class="vh-100" src="web picture.png" alt="" style="min-height:700px; min-width:700px; max-height:900px; max-width:1000px">
        </div>

        </div>
        
      <div class="col-lg-4 col-md-4 col-sm-5 min-vh-100">
        
            <div class="formcontainer vh-100 bg-light" id="formcontainer">
              
                <div class="icon-big text-center icon-warning pt-5">
                      <img src="../BulSU.png" alt="" >
                </div>
                <h2 id="h2">BulSU iTugon</h2>
              <?php if ($msg != "") echo "<h5 class='errormsg'>$msg </h5> "; ?>
              <div class="card-body">
                <form action="" method = "post">                  
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <label>New password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" placeholder="Confirm password" name="con_password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-round w-100 " id="submit">set password</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 ml-auto mr-auto">
                        <a href="/"type="submit" name="" class="btn btn-round w-100 " id="">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>

</body>
</html>