<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
</head>
<body>
   
   <?php
   include_once 'connect.php';
    if(isset($_POST['submit'])){
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = "apk_folder/".$fileName;
        
        $query = "INSERT INTO apk_file_download(apk_name) VALUES ('$fileName')";
        $run = mysqli_query($con,$query);
        
        if($run){
            move_uploaded_file($fileTmpName,$path);
            echo "success";
        }
        else{
            echo "error".mysqli_error($con);
        }
        
    }
    
    ?>
   
   <table border="1px" align="center">
       <tr>
           <td>
               <form action="Staff_Creation.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <button type="submit" name="submit"> Upload</button>
                </form>
           </td>
       </tr>
       <tr>
           <td>
              <?
               $query2 = "SELECT * FROM apk_file_download ";
               $run2 = mysqli_query($con,$query2);
               
               while($rows = mysqli_fetch_assoc($run2)){
                   ?>
               <a href="download.php?file=<?php echo $rows['filename'] ?>">Download</a><br>
               <?php
               }
               ?>
           </td>
       </tr>
   </table>
    
</body>
</html>