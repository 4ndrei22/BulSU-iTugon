<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = /');
  }
?>
<?php
    $msg = "";
    if (isset($_POST['submit'])) {
      $con = new mysqli('localhost', 'root', '', 'db_admin');
      $username = $con->real_escape_string($_POST['username']);
      $newPassword =$con->real_escape_string($_POST['new_password']);
      $password = $con->real_escape_string($_POST['current_password']);
      $confirm_password = $con->real_escape_string($_POST['confirm_password']);
      if(!empty($newPassword) && !empty($password) && !empty($confirm_password)){
        $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
          $user_pass = md5($password);
          $newPass = md5($newPassword);
          $enc_pass = $row['password'];
          if($password == $confirm_password){
            if($user_pass === $enc_pass){
              $sql1 = "UPDATE `accountcreation` SET password = '$newPass' WHERE password = '$user_pass'";
              mysqli_query($con,$sql1);
              $msg = "update successfully";
              header('refresh: 1, url = ChangePassword');
              }else{
              $msg = "Incorrect Password";
              header('refresh: 1, url = ChangePassword');
              }
          }else{
            $msg = "Password didn't match";
            header('refresh: 1, url = ChangePassword');
          }
          
        }else{
          $msg = "$username - This is your current username";
          header('refresh: 1, url = ChangePassword');
        }
      }else{
        $msg = "All input fields are required";
        header('refresh: 1, url = ChangePassword');
      }
    }
 
?>
<?php 
  include "main_header.php";
?>

<body class="">
  <?php
    include 'navBars.php';
    ?>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Change Password </h4>
              </div>
              <div class="card-body">
                <?php 
                  include 'connect.php';
                  $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
                  if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                   }
                ?>
              <?php if ($msg != "") echo $msg . "<br><br>"; ?>
              <form action="ChangePassword.php" method = "post">                  
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $row['username']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" placeholder="Current Password" name="current_password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" placeholder="New Password" name="new_password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name = "submit"class="btn btn-primary btn-round">Change Password</button>
                    </div>
                  </div>
                </form>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>