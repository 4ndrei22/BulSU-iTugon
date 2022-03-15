<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php
include'connect.php';
    if(isset($_POST['submit'])){
    if(!empty($_POST['category'])) {
        $selected = $_POST['category'];
        
            $sortingcondition = "WHERE knowledgebase.title_id = $selected";
        
        //$errormsg = "You have chosen: ' . $selected";
    } else {
        //$errormsg = 'Please select the value.';
    }
    }
?>

<!DOCTYPE html>
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
    <script src="js/get_question_data.js"></script>	
  </head>

<body class="">
  <div class="wrapper">
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
                <img class="icon-simple" src="images/blank-profile-picture-973460_1280.png" alt="">
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
                    <li class="active">
                        <a href="FAQs">
                            <i class="fa fa-book"></i>
                            <p>Knowledgebase</p>
                        </a>
                    </li>
                    <li>
                        <a href="user">
                            <i class="fa fa-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="dropdown ">
                        <a class="dropbtn active " >
                            <i class="fa fa-ticket"></i>
                            Tickets &nbsp; &nbsp;
                            <span class="fa fa-caret-down"></span>
                        </a>
                        <div class="dropdown-content" >
                            <a href="Ticket(open)">Open</a>
                            <a href="Ticket(assigned)">Assigned</a>
                            <a href="Ticket(Pending)">Pending</a>
                        </div>
                    </li>
                </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- nav bar -->
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
      <!-- end nav bar -->
        <div class="content" style="margin-top:5%;">
            
            <?php
                require_once("connect.php");
                $sql = "SELECT * FROM knowledgebase INNER JOIN faq_list ON knowledgebase.title_id = faq_list.category_id $sortingcondition ORDER BY id DESC";
                $result = mysqli_query($con,$sql);
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-user" >
                        <div class="card-header">
                            <h5 class="card-title">
                              Knowledgebase
                            </h5>
                            <p>Create, update, delete category, questions and answers</p>
                            <span><?php echo $errormsg ?></span>
                         </div>
                         <div class="card-body">
                           <div class="row">
                                <div class="col-lg-3 col-md-2 col-sm-3">
                                    <div class="row" >
                                        <div class="col-lg-12 col-md-12 pl-1">
                                            <a href="FAQs(create_category).php" class=" btn text-dark" style="height:41px; background-color: #ffff;">
                                                <i class="fa fa-plus-circle"></i>
                                                    Add category
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-3">
                                    <div class="row" >
                                        <div class="col-lg-12 col-md-12 pl-1">
                                            <a href="tables_Category.php" class=" btn text-dark" style="height:41px; background-color: #ffff;">
                                                <i class="fa fa-plus-circle"></i>
                                                    Edit/Delete category
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-3">
                                    <div align="left" style="padding-bottom:5px;">
                                        <a href="FAQs(create).php" class="btn text-dark" style="height:41px; background-color: #ffff;">
                                            <i class="fa fa-plus-circle"></i>
                                            Add FAQ
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <form action="" method = "post" >
                                        <div class="row">
                                        <div class="col-lg-3 col-md-3 pl-1">
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 pr-1 pt-2">
                                            <div class="form-group">
                                                <select class="form-control " name="category">
                                                    <option value="" disabled selected>Sort</option>
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
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 pl-1">
                                            <div class="form-group">
                                                <input class="btn text-white" type="submit" name="submit" value="Sort"style="height:41px; background-color: #671e1e;">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </div>
                            </div>  
                        <form name="frmUser" method="post" action="">
                            <div class="max-vw-100"Style="overflow-y: scroll;overflow-x: hidden; max-height:650px; min-height:400px;">
                            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            
                            
                            <div class="table-responsive">
                                <table class="tblListForm table" >
                                     <colgroup>
                                       <col span="1" style="width: 15%;">
                                       <col span="1" style="width: 60%;">
                                       <col span="1" style="width: 15%;">
                                       <col span="1" style="width: 10%;">
                                    </colgroup>
                                    <thread>
                                        <tr>
                                            <td>Question</td>
                                            <td>Answer</td>
                                            <td>Category</td>
                                            <td>CRUD Actions</td>
                                        </tr>
                                    </thread>
                                    
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
                                            <td><?php echo $row["question"]; ?></td>
                                            <td><?php echo $row["answer"]; ?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td><a href="FAQs(update)?userId=<?php echo $row["id"]; ?>" class="link">
                                                <i class="fa fa-pencil-square-o" style="font-size:24px"></i></a>
                                                &nbsp;
                                                </a>  
                                                <a href="FAQs(Delete)?userId=<?php echo $row["id"]; ?>"  class="link">
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
                            
                         </div>
                        </form>
                			
                
                    </div>
                </div>
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
 
</body>

</html>