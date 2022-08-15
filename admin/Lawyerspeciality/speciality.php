<?php
session_start();
include '../config.php';

$ls_query="select * from lawyer_speciality ls JOIN services s on ls.services_id=s.serv_id JOIN lawyer l on ls.lawyer_id=l.id";
$ls_result=mysqli_query($conn,$ls_query);

if(isset($_POST['btnAdd']))
{
    $services=$_POST['services_id'];
    $lawyer=$_POST['lawyer_id'];
    $query="INSERT INTO `lawyer_speciality`( `lawyer_id`, `services_id`) VALUES ('$lawyer','$services')";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        header('location:speciality.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
}
include('../includes/header.php'); 
include('../includes/navbar.php');


$s_query="select * from services";
$s_result=mysqli_query($conn,$s_query);

$l_query="select * from lawyer";
$l_result=mysqli_query($conn,$l_query);
?>

<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Speciality Id</th>
            <th>Lawyer Id</th>
            <th>Services Id</th>
            <th>Actions</th>
        </tr>
        <?php
         while($ls_row=mysqli_fetch_assoc($ls_result))
         {
         ?>
        <tr>
            <td><?php echo $ls_row['speciality_id'];?></td>
            <td><?php echo $ls_row['fullname'];?></td>
            <td><?php echo $ls_row['serv_name'];?></td>
            <td><a href="edit.php?id=<?php echo $ls_row['speciality_id'];?>" class="btn btn-success">Edit</a> | <a href="delete.php?id=<?php echo $ls_row['speciality_id'];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <form method="post">
        
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
        <label>Select Services </label>
        <select name="services_id" class="form-control">
            <option>Select Services:</option>
             <?php
                while($s_row=mysqli_fetch_assoc($s_result))
                {
            ?>
                <option value="<?php echo $s_row['serv_id'];?>"><?php echo $s_row['serv_name'];?></option>
            <?php
                }
            ?> 
        </select>
        <br>
        <input type="submit" class="btn btn-primary" value="Add LawyerSpeciality" name="btnAdd"/>
    </form>
</div>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
?>