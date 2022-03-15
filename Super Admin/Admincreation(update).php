<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>

<?php
	$msg = "";
  include 'connect.php';
	if (isset($_POST['submit'])) {
        $account_id = $_GET["userId"];
        $firstname = $con->real_escape_string($_POST['firstnameUP']);
        $lastname = $con->real_escape_string($_POST['lastnameUP']);
        $email = $con->real_escape_string($_POST['emailUP']);
        $contactnum = $con->real_escape_string($_POST['contact_numberUP']);
        $accesslvl = $con->real_escape_string($_POST['accessLvlUP']);
        $username = $con->real_escape_string($_POST['usernameUP']);
        $password = $con->real_escape_string($_POST['passwordUP']);

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                    if($email == $row['email']){
                        $sql1 = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
                        if(mysqli_num_rows($sql1) > 0){
                            $row1 = mysqli_fetch_assoc($sql1);
                            if($username == $row1['username']){
                                $status = "Enable";
                                $encrypt_pass = md5($password);
                                $insert_query = mysqli_query($con, "UPDATE accountcreation SET adminkey='{$accesslvl}', firstname='{$firstname}', lastname='{$lastname}', email='{$email}', contactNum='{$contactnum}',username='{$username}', password='{$encrypt_pass}',status='{$status}' WHERE unique_id = $account_id");
                                if($insert_query){
                                    $color = "success";
                                    $msg = "success";
                                    header('refresh: 1, url = AdminCreation');
                                }
                            }else{
                                $color = "danger";
                                $msg =  "$username - This username already exist!";
                                header('refresh: 1, url = AdminCreation');
                            }
                        }
                    }else{
                        $color = "danger";
                        $msg =  "$email - This email already exist!";
                        header('refresh: 1, url = AdminCreation');
                    }
                        
                }
            }else{
                $color = "danger";
                $msg = "$email is not a valid email";
                header('refresh: 1, url = Admincreation(update)');}
    }
    $select_query = "SELECT * FROM knowledgebase WHERE id='" . $_GET["userId"] . "'";
                    $result = mysqli_query($con,$select_query);
                    $row = mysqli_fetch_array($result);
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
                                <h5 class="card-title">Update Account</h5>
                            </div>
                            <div class="card-body form signup">
                                <?php if ($msg != "") echo "<h5 class='errormsg text-$color'>$msg </h5> "; ?>
                                <?php
                                    $select_query = "SELECT * FROM accountcreation WHERE unique_id='" . $_GET["userId"] . "'";
                                    $result = mysqli_query($con,$select_query);
                                    $row = mysqli_fetch_array($result);
                                ?>
                                <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="firstnameUP" id="firstnameUP" value="<?php echo $row['firstname']; ?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="lastnameUP" id="lastnameUP" value="<?php echo $row['lastname']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="example@email.com" name="emailUP" id="emailUP" value="<?php echo $row['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="09123456789" name="contact_numberUP" id="contact_numberUP" value="<?php echo $row['contactNum']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label for="access">Access Level</label>
                                                <select class="form-control" name="accessLvlUP" id="accessLvl" >
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
                                                <input type="text" class="form-control" placeholder="Username" name="usernameUP" id="usernameUP" value="<?php echo $row['username']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="passwordUP" id="passwordUP" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="update ml-auto mr-auto">
                                            <button type="submit" name = "submit" id="submit" class="btn btn-primary btn-round">Update</button>
                                            <a href="AdminCreation" type="submit" name = "" id="" class="btn btn-primary btn-round">Cancel</a>
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