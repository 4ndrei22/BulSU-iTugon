<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../BulSU.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      BulSU iTugon
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../CSS Files/bootstrap.min.css" rel="stylesheet" />
    <link href="../CSS Files/Staff_Dashboard.css?v=2.0.1" rel="stylesheet" /> 
    <link href="../CSS Files/demo.css" rel="stylesheet" />
    <!-- JS Files -->
    <script src="../JS Files/Autocomplete.js"></script>
    <script src="../JS Files/core/jquery.min.js"></script>
    <script src="../JS Files/core/popper.min.js"></script>
    <script src="../JS Files/core/bootstrap.min.js"></script>
    <script src="../JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../JS Files/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script>
      //show a confirmation and redirect to the delete profile script
      function deleteProfile() {
        if (confirm("Do you really want to delete your profile?")) {
            location.href = 'delete';
        }
    }
    </script>
  </head>

<body class="">
    <?php
    include 'navBars.php';
    ?>
              <div class="content" style="margin-top:9%;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-user" >
                      <div class="card-header">
                        <h5 class="card-title">
                          Create Category
                        </h5>
                        <p>Please fill this form and submit to add employee record to the database.</p>
                      </div>
                      <div class="card-body">
                           <?php
                            require_once("connect.php");
                            if(isset($_POST['submit'])) {
                            	$sql = "INSERT INTO faq_list (title) VALUES ('" . $_POST["category"] . "')";
                            	$query = mysqli_query($con,$sql);
                            	if($query){
                                        $message = "Category created successfully";
                                        $color="success";
                                        echo "<meta http-equiv='refresh' content='1'>";
                                      }
                            }
                            ?>
                            <div class="message" ><?php if(isset($message)) { echo "<span class='errormsg text-$color'>$message </span> "; } ?></div><br/>
                            <form action="" method="post">
                                
                                <div class = "form-group">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control"  value="">
                                </div>
                                
                                <input type="submit" name="submit" class="btn btn-primary btn-round"value="Submit">
                                <a href="FAQs" class="btn btn-secondary ml-2 btn-round">Cancel</a>
                            </form>
                    </div>        
              </div>
              <footer class="footer footer-black  footer-white ">
                <div class="container-fluid">
                  <div class="row">
                    <nav class="footer-nav">
        
                    </nav>
                    <div class="credits ml-auto">
        
                    </div>
                  </div>
                </div>
              </footer>
            </div>
              </div>
            </div>
        </div>
    </div>
 
</body>

</html>