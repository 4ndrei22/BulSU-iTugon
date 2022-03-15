<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once("connect.php");
    $sql = "DELETE FROM faq_list WHERE category_id='" . $_POST["id"] . "'";
    mysqli_query($con,$sql);
    echo "<meta http-equiv='refresh' content='0;url=tables_Category'>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../Image Files/Logo/BulSU.png">
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
  <link href="../CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="../CSS Files/demo.css" rel="stylesheet" />
  <link href="../CSS Files/AssignedTicket.css" rel="stylesheet" />
  <!-- JS Files -->
  <script src="../JS Files/core/jquery.min.js"></script>
  <script src="../JS Files/core/popper.min.js"></script>
  <script src="../JS Files/core/bootstrap.min.js"></script>
  <script src="../JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../JS Files/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
</head>

<body class="" style="overflow:hidden;">
  <?php
    include 'navBars.php';
    ?>
      <div class="content" style="margin-top:9%;">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-user">
              <div class="card-header ">
                <h5 class=" card-title">
                  Delete FAQs &nbsp; &nbsp;
                </h5>
              </div>
              <div class="card-body">
                    <form action="FAQs(delete_category)" method="post">
                        <div class="alert "Style="background-color: #671e1e;">
                            <input type="hidden" name="id" value="<?php echo $_GET["userId"]; ?>"/>
                            <?php
                                include 'connect.php';
                                $id = $_GET["userId"];
                                $sql = mysqli_query($con,"SELECT * FROM faq_list WHERE category_id=$id");
                                if(mysqli_num_rows($sql)>0){
                                    $row = mysqli_fetch_assoc($sql);
                                }
                            ?>
                            <p>Are you sure you want to delete "<?php echo $row["title"]; ?>" category?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="tables_Category" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
              </div>
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
