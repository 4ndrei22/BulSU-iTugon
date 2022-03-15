<?php
    require_once("connect.php");
    $sql = "SELECT * FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id GROUP BY ticketinfo.ticket_assignee";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)) {
        $firstname = $row['firstname'];
        $sql1 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketAssigned FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status IN ('Assigned', 'Pending', 'Reopened')  AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
                                                
        $sql2 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketResolved FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status = 'Resolved' AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
                                                            
        $sql3 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketClosed FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status = 'Closed' AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
        $result1 = mysqli_query($con, $sql1);
        $result2 = mysqli_query($con, $sql2);
        $result3 = mysqli_query($con, $sql3);
        if(mysqli_num_rows($result1)>0){
            $row1 = mysqli_fetch_assoc($result1);
            $assigned = $row1['ticketAssigned'];
        }
        if(mysqli_num_rows($result2)>0){
            $row2 = mysqli_fetch_assoc($result2);
            $resolved = $row2['ticketResolved'];
        }
        if(mysqli_num_rows($result3)>0){
            $row3 = mysqli_fetch_assoc($result3);
            $closed = $row3['ticketClosed'];
        }
?>

    <tr class="">
        <td><?php echo $firstname ?></td>
        <td><?php echo $assigned; ?></td>
        <td><?php echo $resolved; ?></td>
        <td><?php echo $closed; ?></td>
    </tr>
<?php      
        }
         ?>                                           