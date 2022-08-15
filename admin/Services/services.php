<!-- services section -->
<?php
session_start();
include '../config.php';

$ser_query="select * from services JOIN category on services.cat_id=category.catgry_id";
$ser_result=mysqli_query($conn,$ser_query);

if(isset($_POST['btnAdd']))
{
    $name=htmlspecialchars($_POST['txtName']);
    $category=htmlspecialchars($_POST['txtname']);
    $query = "INSERT INTO `services`(`serv_name`, `cat_id`) VALUES('$name','$category')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header('location:services.php');
    }else{
        echo "Record Not Inserted".mysqli_error($conn);
    }
}


include('../includes/header.php'); 
include('../includes/navbar.php');

$cat_query="select * from category";
$cat_result=mysqli_query($conn,$cat_query);

?>

<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Service Category</th>
            <th>Actions</th>
        </tr>
        <?php
       
        while($ser_row=mysqli_fetch_assoc($ser_result))
        {
        ?>
        <tr>
            <td><?php echo $ser_row['serv_id'];?></td>
            <td><?php echo $ser_row['serv_name'];?></td>
            
            <td><?php echo $ser_row['catgry_name'];?></td>
            <!-- <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['st_image']);?>" width="100px" height="100px"/></td> -->
            <td><a href="edit.php?id=<?php echo $ser_row['serv_id'];?>" class="btn btn-success">Edit</a> | <a href="delete.php?id=<?php echo $ser_row['serv_id'];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <!-- Service Add Section -->
 
    <form method="post">
        <label>Enter Service Name: </label>
        <input type="text" class="form-control" name="txtName" />
        <br>
        <select name="txtname" class="form-control">
            <option>Enter Service Category:</option>
            <?php
                while($cat_row=mysqli_fetch_assoc($cat_result))
                {
            ?>
                <option value="<?php echo $cat_row['catgry_id'];?>"><?php echo $cat_row['catgry_name'];?></option>
            <?php
                }
            ?>
        </select>
        <br>
        <input type="submit"  class="btn btn-primary" value="Add Service" name="btnAdd"/>
    </form>
    </div>
    <?Php
    include('../includes/footer.php'); 
    ?>