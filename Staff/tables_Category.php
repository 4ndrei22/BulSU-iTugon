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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
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
</head>

<body class="">
  <?php include 'navBars.php'; ?>
      <div class="content" style="margin-top:7%;">
            
            <?php
                require_once("connect.php");
                $sql = "SELECT * FROM faq_list";
                $result = mysqli_query($con,$sql);
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-user" >
                        <div class="card-header">
                            <h5 class="card-title">
                              Category
                            </h5>
                            <p>update, delete category</p>
                            <span><?php echo $errormsg ?></span>
                         </div>
                         <div align="right" style="padding-bottom:5px; padding-right:2%;">
                            <a href="FAQs" class="link"><i class="	fa fa-list"></i> Knowledgebase List</a>
                        </div>
                         <div class="card-body">
                        <form name="frmUser" method="post" action="">
                            <div class="max-vw-100"Style="overflow-y: scroll;overflow-x: hidden; max-height:650px; min-height:400px;">
                            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            
                            
                            <div class="table-responsive">
                                <table class="tblListForm table" >
                                     
                                    <thread>
                                        <tr>
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
                                            <td><?php echo $row["title"]; ?></td>
                                            <td><a href="FAQs(update_category)?userId=<?php echo $row["category_id"]; ?>" class="link">
                                                <i class="fa fa-pencil-square-o" style="font-size:24px"></i></a>
                                                &nbsp;
                                                </a>  
                                                <a href="FAQs(delete_category)?userId=<?php echo $row["category_id"]; ?>"  class="link">
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
  </div>

</body>

</html>