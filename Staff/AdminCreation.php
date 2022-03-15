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
              $msg =  "$email - This email already exist!";
              header('refresh: 1, url = AdminCreation');
            }else{
              $sql1 = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
              if(mysqli_num_rows($sql1) > 0){
                $msg =  "$username - This username already exist!";
                header('refresh: 1, url = AdminCreation');
              }else{
                    $ran_id = rand(time(), 100000000);
                    $status = "Offline now";
                    $encrypt_pass = md5($password);
                    $insert_query = mysqli_query($con, "INSERT INTO accountcreation (unique_id, adminkey, firstname, lastname, email, contactNum,username, password, img, status) 
                    VALUES ({$ran_id},'{$accesslvl}','{$firstname}','{$lastname}', '{$email}','{$contactnum}','{$username}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                    if($insert_query){
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
              <img class="icon-simple" src="images/<?php echo $row['img']; ?>" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="">
            <a href="../Dashboard(staff)">
              <i class="fa fa-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="dropdown ">
              <a class="dropbtn active " >
                <i class="fa fa-ticket"></i>
                Tickets &nbsp; &nbsp;
                <span class="fa fa-caret-down"></span>
              </a>
              <div class="dropdown-content" >
                <a href="./Ticket(open)">Open</a>
                <a href="./Ticket(Pending)">Pending</a>
                <a href="./Ticket(reopened)">Reopened</a>
              </div>
          </li>
          <li>
            <a href="./FAQs">
              <i class="fa fa-book"></i>
              <p>Knowledgebase</p>
            </a>
          </li>
          <li class="active">
            <a href="./AdminCreation">
              <i class="fa fa-plus"></i>
              <p style="font-size: 10px;">Create Employee Account</p>
            </a>
          </li>
          <li>
            <a href="./user">
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
            <a class="navbar-brand" href="javascript:;">BulSU iTugon</a>
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
                <?php if ($msg != "") echo "<h5 class='errormsg'>$msg </h5> "; ?>
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
                        <input type="text" class="form-control" placeholder="abc@email.com" name="email" id="email" required>
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
                <div class="table-display">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Access Level</th>
                      <th>Email</th>
                      <th>Contact Number</th>
                      <th>Username</th>
                    </thead>
                    <tbody>
                    <?php
                      include "connect.php";
                      $sql = "SELECT * FROM accountcreation WHERE adminkey = 1 AND 2";
                      $result = $con->query($sql);
                      if(mysqli_num_rows($result) > 0){
                      // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<tr><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . "</td><td>" . $row["adminkey"] .
                               "</td><td>". $row["email"] . "</td><td>". $row["contactNum"] . "</td><td>". $row["username"] . "</td></tr>";
                        }
                      echo "</table>";
                      } else { echo "0 results"; }
                      $con->close();
                      ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
        
      </div>
    </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <!-- <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul> -->
            </nav>
            <div class="credits ml-auto">
              <!-- <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span> -->
            </div>
          </div>
        </div>
      </footer>
  </div>
  </div>
  
</body>
</html>