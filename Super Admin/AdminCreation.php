<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php

if(isset($_POST['formSubmit']) )
{
  $varMovie = $_POST['formMovie'];
  $varName = $_POST['formName'];
  $varGender = $_POST['formGender'];
  $errorMessage = "";

  // - - - snip - - - 
}

?>
<?php
	$msg = "";
  include 'connect.php';
	if (isset($_POST['submit'])) {

        $firstname = $con->real_escape_string($_POST['firstname']);
        $lastname = $con->real_escape_string($_POST['lastname']);
        $email = $con->real_escape_string($_POST['email']);
        $contactnum = $con->real_escape_string($_POST['contact_number']);
        $accesslvl = $con->real_escape_string($_POST['accessLvl']);
        $username = $con->real_escape_string($_POST['usernameR']);
        $password = $con->real_escape_string($_POST['passwordR']);

    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($contactnum) && !empty($accesslvl) && !empty($username) && !empty($password)){
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $color = "danger";
              $msg =  "$email - This email already exist!";
              header('refresh: 1, url = AdminCreation');
            }else{
              $sql1 = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
              if(mysqli_num_rows($sql1) > 0){
                $color = "danger";
                $msg =  "$username - This username already exist!";
                header('refresh: 1, url = AdminCreation');
              }else{
                $ran_id = rand(time(), 100000000);
                $status = "Enable";
                $encrypt_pass = md5($password);
                $insert_query = mysqli_query($con, "INSERT INTO accountcreation (unique_id, adminkey, firstname, lastname, email, contactNum,username, password, img, status)
                              VALUES ({$ran_id},'{$accesslvl}','{$firstname}','{$lastname}', '{$email}','{$contactnum}','{$username}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                if($insert_query){
                    $color = "success";
                    $msg = "success";
                    header('refresh: 1, url = AdminCreation');
                }
              }
            }
      }else{
        $msg = "$email is not a valid email";
        header('refresh: 1, url = AdminCreation');}
    }else{ 
      $msg = "all input fields are required";
      header('refresh: 1, url = AdminCreation');
    }
	 }
?>
<?php 
  include "main_header.php";
?>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a class="simple-text logo-mini">
          <div class="logo-image-small">
            <?php 
              include 'connect.php';
              $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
              }
              ?>
              <img class="icon-simple" src="images/1645276916blank-profile-picture-973460_1280.png" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li >
                <a href="../Dashboard(super)">
                    <i class="fa fa-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li  class="active">
                <a href="AdminCreation">
                    <i class="fa fa-plus"></i>
                    <p style="font-size: 10px;">Create Employee Account</p>
                </a>
            </li>
            <li>
                <a href="user">
                    <i class="fa fa-user"></i>
                    <p>User Profile</p>
                </a>
            </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top" Style="background-color: #671e1e;">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="" style="font-size:20px;">BulSU iTugon</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="./ChangeUsername">Change Username</a>
                  <a class="dropdown-item" href="./ChangePassword">Change Password</a>
                  <a class="dropdown-item" href="./truncateUser">Logout</a>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-user">
                <div class="card-header">
                  <h5 class="card-title">Create Account</h5>
                </div>
                <div class="card-body form signup">
                <?php if ($msg != "") echo "<h5 class='errormsg text-$color'>$msg </h5> "; ?>
                <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" required>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="example@email.com" name="email" id="email" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" placeholder="09123456789" name="contact_number" id="contact_number" required>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                          <label for="access">Access Level</label>
                          <select class="form-control" name="accessLvl" id="accessLvl" required>
                            <!-- <option value="">Select access level</option> -->
                            <option value="1"name="Staff" id="Staff">Staff</option>
                            <option value="2" name="Super Admin" id="Super Admin">Super Admin</option>
                          </select>
                      </div>
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="usernameR" id="usernameR" required>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="passwordR" id="passwordR" required>
                      </div>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name = "submit" id="submit" class="btn btn-primary btn-round">Create</button>
                    </div>
                    </div>
          </form>
              </div>
            </div>
          </div>
          <!-- User directory -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> User Directory </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <label></label>
                </div>
                  <div class="col-md-auto"> 
                    <label>Search</label>
                </div>
                  <div class="col-md-4">
                      <input type="text" style="width: 100%;" placeholder="Search..." value="">
                  </div>
                  <div class="col-md-auto">
                    <button><i class="fa fa-search"></i></button>
                  </div>
                </div>
                <div class="table-display vh-100" style=" max-height: 700px; min-height:400px">
                     <?php
                            require_once("connect.php");
                            $sql = "SELECT * FROM accountcreation INNER JOIN lu_role ON accountcreation.adminkey = lu_role.id WHERE adminkey IN (1, 2) ORDER BY accountcreation.date_created DESC";
                            $result = mysqli_query($con,$sql);
                            
                        ?>
                        <form name="frmUser" method="post" action="">
                            <div class="max-vw-100">
                            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            <table class="table">
                                <thead class=" text-primary">
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Access Level</th>
                                  <th>Email</th>
                                  <th>Contact Number</th>
                                  <th>Username</th>
                                  <th>Status</th>
                                </thead>
                                
                                <?php
                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                                    if($i%2==0)
                                    $classname="evenRow";
                                    else
                                    $classname="oddRow";
                                ?>
                                <tbody>
                                    <tr class="<?php if(isset($classname)) echo $classname;?>">
                                        <td><?php echo $row["firstname"]; ?></td>
                                        <td><?php echo $row["lastname"]; ?></td>
                                        <td><?php echo $row["role_name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["contactNum"]; ?></td>
                                        <td><?php echo $row["username"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                        <td><a href="Admincreation(update)?userId=<?php echo $row["unique_id"]; ?>" class="link">
                                                <i class="fa fa-pencil-square-o" style="font-size:24px"></i>
                                            </a>
                                            &nbsp;
                                            <a href="Admincreation(delete)?userId=<?php echo $row["unique_id"]; ?>"  class="link">
                                               <i class="fa fa-trash-o" style="font-size:24px"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            
                            </table>
                          </div>   
                        </form>
               
              </div>
            </div>
          </div>
        </div>
        </form>
        
      </div>
    </div>
      
  </div>
  </div>
  
</body>
</html>