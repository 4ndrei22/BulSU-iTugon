<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = /');
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

<body class="" style="overflow:hidden;">
   <?php
    include 'navBars.php';
    ?>
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
              <div class="content" style="margin-top:9%;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-user" >
                      <div class="card-header">
                        <h5 class="card-title">
                          Create FAQs
                        </h5>
                        <p>Please fill this form and submit to add FAQ record to the database.</p>
                      </div>
                      <div class="card-body">
                            <?php
                            require_once("connect.php");
        
                            	if(isset($_POST['submit']))
                                {
                                    $question = $_POST['question'];
                                    $answer = $_POST['answer'];
                                    $category = $_POST['category'];
                                
                                    $query = "INSERT INTO knowledgebase (question,answer,title_id) VALUES ('{$question}','{$answer}','{$category}')";
                                    $query_run = mysqli_query($con, $query);
                                
                                    if($query_run)
                                    {
                                        $message = "create successfully";
                                        $color="success";
                                        echo "<meta http-equiv='refresh' content='1;url=FAQs'>";
                                    }
                                    else
                                    {
                                        $color="Unable to create due to error";
                                        header('refresh: 1, url = FAQs(create)');
                                    }
                                }
                            
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                <div class = "form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category" id="category" >
                                        <span class="fa fa-caret-down"></span>
                                        <!-- <option value="">Select access level</option> -->
                                        <?php 
                                            // Fetch Department
                                            $sql = "SELECT * FROM faq_list";
                                            $data = mysqli_query($con,$sql);
                                            while($row = mysqli_fetch_assoc($data) ){
                                                $faq_id = $row['category_id'];
                                                $title = $row['title'];
                                              
                                                // Option
                                                echo "<option value='".$faq_id."' >".$title."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" name="question" class="form-control"  value="">
                                </div>
                                <div class="form-group">
                                    <label>Answer</label>
                                    <textarea name="answer" class="form-control "></textarea>
                                </div>
                                
                                <input type="submit" name="submit" class="btn btn-primary btn-round"value="submit">
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