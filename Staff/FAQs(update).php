<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
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
  <link href="../CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="../CSS Files/demo.css" rel="stylesheet" />
  <link href="../CSS Files/AssignedTicket.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS Files -->
  <script src="../JS Files/core/jquery.min.js"></script>
  <script src="../JS Files/core/popper.min.js"></script>
  <script src="../JS Files/core/bootstrap.min.js"></script>
  <script src="../JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../JS Files/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</head>

<body class="">
  <?php
    include 'navBars.php';
    ?> 
      <div class="content" style="margin-top:5%; ">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">
                  Update FAQs &nbsp; &nbsp;
                </h5>
                <p>Please edit the input values and submit to update the employee record.</p>
                <span><?php echo $errormsg ?></span>
              </div>
              <div class="card-body">
                  <?php
                    include 'connect.php';

                    	if(isset($_POST['submit']))
                        {
                            $question = $_POST['question'];
                            $answer = $_POST['answer'];
                            $category = $_POST['category'];
                            $id = $_POST["id"];
                        
                            $query = "UPDATE knowledgebase SET question='{$question}',answer='{$answer}',title_id='{$category}' WHERE id='{$id}'";
                            $query_run = mysqli_query($con, $query);
                            
                            $message = "update successfully";
                             $color="success";
                            header("Location:FAQs.php");
                  
                        }
                    
                    ?>
                  <?php
                    require_once("connect.php");
                    $select_query = "SELECT * FROM knowledgebase INNER JOIN faq_list on faq_list.category_id = knowledgebase.title_id WHERE id='" . $_GET["userId"] . "'";
                    $result = mysqli_query($con,$select_query);
                    $row = mysqli_fetch_array($result);
                    ?>
                <form name="frmUser" method="post" action="" >
                    <div class="message" id="message"><?php if(isset($message)) { echo "<h5 class='errormsg text-$color'>$message </h5> "; } ?></div>
                    <div class = "form-group">
                            <label>Category</label>
                            <select class="form-control" name="category" id="category" >
                                <span class="fa fa-caret-down"></span>
                                <option value="<?php echo $row['title_id']; ?>"><?php echo $row['title']; ?></option>
                                <!-- <option value="">Select category</option> -->
                                <?php 
                                    // Fetch Department
                                    $sql = "SELECT * FROM faq_list";
                                    $data = mysqli_query($con,$sql);
                                    while($row1 = mysqli_fetch_assoc($data) ){
                                        $faq_id = $row1['category_id'];
                                        $title = $row1['title'];
                                        // Option
                                        echo "<option value='".$faq_id."' >".$title."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" class="form-control" placeholder="Question" name="question" id="question" value="<?php echo $row['question']; ?>">
                    </div>
                     <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control vh-100" placeholder="Answer" name="answer" id="answer" style="max-height:400px; min-height:400px;"><?php echo $row['answer']; ?></textarea>
                     </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" hidden>
                            <button type="submit" name="submit" class="btn btn-primary btn-round">Update</button>
                            <a href="FAQs"type="submit"  class="btn btn-secondary ml-2 btn-round">Cancel</a>
                        </div>
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
 <script type="text/javascript">
    function exitFunction() {
      var txt;
      if (confirm("Are you sure?")) {
        wwindow.location.assign("FAQs.php")
      } else {
        window.location = "FAQs.php"
      }
      //document.getElementById("message").innerHTML = txt;
    }
</script>
</body>

</html>
