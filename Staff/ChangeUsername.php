<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = /');
  }
?>
<?php
    $msg = "";
    if (isset($_POST['submit'])) {
      include 'connect';
      $username = $con->real_escape_string($_POST['CurUsername']);
      $newUsername =$con->real_escape_string($_POST['NewUsername']);
      $password = $con->real_escape_string($_POST['CUPassword']);
      if(!empty($newUsername) && !empty($password)){
        $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
          $user_pass = md5($password);
          $enc_pass = $row['password'];
          if($user_pass === $enc_pass){
            $sql1 = "UPDATE `accountcreation` SET username = '$newUsername' WHERE username = '$username'";
            mysqli_query($con,$sql1);
            $msg = "update successfully";
            header('refresh: 1, url = ChangeUsername');
          }else{
            $msg = "Incorrect Password";
            header('refresh: 1, url = ChangeUsername');
          }
        }else{
          $msg = "$newUsername - This username already exists";
          header('refresh: 1, url = ChangeUsername');
        }
      }else{
        $msg = "All input fields are required";
        header('refresh: 1, url = ChangeUsername');
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
                  <h4 class="card-title"> Change Username </h4>
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
                  <form action="ChangeUsername" method = "post">                  
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Current Username</label>
                          <input type="text" class="form-control" placeholder="Current Username" name="CurUsername" value="<?php echo $row['username']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>New Username</label>
                          <input type="text" class="form-control" placeholder="New Username" name="NewUsername" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="password" name="CUPassword" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="update ml-auto mr-auto">
                        <button type="submit" name="submit" class="btn btn-primary btn-round">Change Username</button>
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