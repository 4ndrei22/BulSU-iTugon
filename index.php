<?php 
  session_start();
?>
<?php
	$msg = "";
  
	if (isset($_POST['submit'])) {
		include 'connect.php';
        //$username = mysqli_real_escape_string($con, $_POST['usernameL']);
        $username = ($_POST['usernameL']);
        $password = ($_POST['passwordL']);
        //$password = mysqli_real_escape_string($con, $_POST['passwordL']);
        if(!empty($username) && !empty($password)){
            $sql = mysqli_query($con,"SELECT * FROM accountcreation WHERE username = '$username'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $user_pass = md5($password);
                $enc_pass = $row['password'];
                if($user_pass === $enc_pass){
                    $status = "Active now";
                    $sql2 = mysqli_query($con,"SELECT * FROM accountcreation WHERE username = '$username' AND status = 'Enable'");
                    if($sql2){
                      if($row['adminkey'] == 1){
                        $_SESSION['U_unique_id'] = $row['unique_id'];
                        $_SESSION['accesslvl'] = $row['adminkey'];
                        header("location: Dashboard(staff)");
                        $msg = "success";
                      }elseif($row['adminkey'] == 2){
                        $_SESSION['U_unique_id'] = $row['unique_id'];
                        $_SESSION['accesslvl'] = $row['adminkey'];
                        header("location: Dashboard(super)");
                        $msg = "success";
                      }else{
                          $msg = "Your account is for mobile application only.";
                      }
                       
                    }else{
                      $msg = "Something went wrong. Please try again!";
                      //header('refresh: 1, url = /');
                    }
                }else{
                  $msg = "Username or Password is Incorrect!";
                   //header('refresh: 1, url = /');
                }
            }else{
              $msg = "$username - This username not Exist!";
              //header('refresh: 1, url = /');
            }
        }else{
          $msg = "All input fields are required!";
          //header('refresh: 1, url = /');
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
                <form action="index" method = "post" autocomplete="off">     
                    <div class="row d-lg-none">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <p class="text-center">If you are a BulSU stakeholder, you can download and access the BulSU iTugon Mobile Application by tapping the button below.&nbsp;<i class="fa fa-hand-o-down"></i></p>
                      </div>
                    </div>
                  </div>
                  <div class="row d-lg-none">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                          <?php
                          include'connect.php';
                               $query2 = "SELECT * FROM apk_file_download ";
                               $run2 = mysqli_query($con,$query2);
                               if(mysqli_num_rows($run2) > 0){
                                   $rows = mysqli_fetch_assoc($run2);
                               }
                              ?>
                            <a href="app-release.apk"class="btn btn-round w-100" download="BulSU iTugon.apk">Download</a>
                      </div>
                    </div>
                  </div>
                  <div class="row d-lg-none">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <p class="text-center">Having trouble downloading the<br> application?</p>
                      </div>
                    </div>
                  </div>
                  <div class="row d-lg-none">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <p class="text-center">contact us at <br> bulsuitugon@gmail.com</p>
                      </div>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <p><i class="fa fa-warning"></i>&nbsp;This login form is for staffs and admin only</p>
                      </div>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="usernameL" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="passwordL" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                    <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-round w-100" id="submit">Log in</button>
                    </div>
                  </div>
                  <div class="row d-none d-lg-block">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                              <a href="forgotpassword" class="forgot text-center text-decoration-none">Forgot Password</a>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>

</body>
</html>