<?php
session_start();
include '../config.php';

$app_query="select * from appoinment JOIN client on appoinment.client_id=client.cust_id JOIN lawyer on appoinment.laywer_id=lawyer.id";
$app_result=mysqli_query($conn,$app_query);

if(isset($_POST['btnAdd']))
{
    $date=$_POST['date'];
    $reason=$_POST['reason'];
    $client=$_POST['client_id'];
    $lawyer=$_POST['lawyer_id'];
    $status=$_POST['status'];
    $meetingplace=$_POST['place'];
    $query = "INSERT INTO `appoinment` (`date`, `reason`, `client_id`, `laywer_id`, `status`, `meeting_place`) VALUES ('$date','$reason','$client','$lawyer','$status','$meetingplace')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header('location:appointment.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
}

include('../includes/header.php'); 
include('../includes/navbar.php');


$c_query="select * from client";
$c_result=mysqli_query($conn,$c_query);

$l_query="select * from lawyer";
$l_result=mysqli_query($conn,$l_query);



?>


<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Reason</th>
            <th>Client Name</th>
            <!-- <th>City Id</th> -->
            <th>lawyer Name</th>
            <th>Status</th>
            <th>Meeting Place</th>
            <th>Actions</th>
        </tr>
        <?php
         while($app_row=mysqli_fetch_assoc($app_result))
         {
         ?>
        <tr>
            <td><?php echo $app_row['id'];?></td>
            <td><?php echo $app_row['date'];?></td>
            <td><?php echo $app_row['reason'];?></td>
            <td><?php echo $app_row['firstName'].$app_row['lastName'];?></td>
            <td><?php echo $app_row['fullname'];?></td>
            <td><?php echo $app_row['status'];?></td>
            <td><?php echo $app_row['meeting_place'];?></td>
            
            
            <td><a href="edit.php?id=<?php echo $app_row['id'];?>" class="btn btn-success">Edit</a> | <a href="delete.php?id=<?php echo $app_row['id'];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <form method="post">
        <label>Enter Date: </label>
        <input type="text" class="form-control" name="date"/>
        <label>Enter Reason: </label>
        <input type="text" class="form-control" name="reason"/>
        <br>
        <label>Select Client </label>
        <select name="client_id" class="form-control">
            <option>Select Client:</option>
             <?php
                while($c_row=mysqli_fetch_assoc($c_result))
                {
            ?>
                <option value="<?php echo $c_row['cust_id'];?>"><?php echo $c_row['firstName'].$c_row['lastName'];?></option>
            <?php
                }
            ?> 
        </select>
        <br>
        <label>Select Lawyer </label>
        <select name="lawyer_id" class="form-control">
            <option>Select Lawyer:</option>
             <?php
                while($l_row=mysqli_fetch_assoc($l_result))
                {
            ?>
                <option value="<?php echo $l_row['id'];?>"><?php echo $l_row['fullname'];?></option>
            <?php
                }
            ?> 
        </select>
        <br>
       
        <label>Enter Status: </label>
        <input type="text" class="form-control" name="status"/>
        <label>Meeting Place: </label>
        <input type="text" class="form-control" name="place"/>
        <br>
        <input type="submit" class="btn btn-primary" value="Add Appointment" name="btnAdd"/>
    </form>
</div>

<?php
include('../includes/footer.php');
include('../include/script.php');
?>