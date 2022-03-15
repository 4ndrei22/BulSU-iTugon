<?php
    include'connect.php';
 
    //$cat = array();
 
    //for Samsung
    //$sql="select * from product left join category on category.catid=product.catid where product.catid='1'";
    $sql="SELECT * FROM ticket_info WHERE Status = 'Open'";
    $query=$conn->query($sql);
    $open = $query->num_rows;
 
    //for Apple
    //$sql="select * from product left join category on category.catid=product.catid where product.catid='2'";
    $sql="SELECT * FROM ticket_info WHERE Status = 'Pending'";
    $aquery=$conn->query($sql);
    $pending = $aquery->num_rows;
 
    //for Vivo
    //$sql="select * from product left join category on category.catid=product.catid where product.catid='3'";
    $sql="SELECT * FROM ticket_info WHERE Status = 'Reopened'";
    $vquery=$conn->query($sql);
    $reopened = $vquery->num_rows;
 
    //for Sony
    //$sql="select * from product left join category on category.catid=product.catid where product.catid='4'";
    $sql="SELECT * FROM ticket_info WHERE Status = 'Resolved'";
    $squery=$conn->query($sql);
    $resolved = $squery->num_rows;
 
    //for Nokia
    //$sql="select * from product left join category on category.catid=product.catid where product.catid='5'";
    $sql="SELECT * FROM ticket_info WHERE Status = 'Closed'";
    $nquery=$conn->query($sql);
    $closed = $nquery->num_rows;
 
?>
<php>