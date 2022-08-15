
<!-- Done All work -->

<?php
session_start();
include '../config.php';
if(isset($_POST['btnAdd']))
{
    $name=$_POST['txtname'];

    $ca_query = "INSERT INTO category(`catgry_name`) VALUES ('$name')";
    $ca_result=mysqli_query($conn,$ca_query);
    if($ca_result)
    {
        header('location: category.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
   
}

include('../includes/header.php'); 
include('../includes/navbar.php'); 

$query="select * from category";
$result=mysqli_query($conn,$query);
   


?>
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        <?php
        while($row=mysqli_fetch_assoc($result))
        {
        ?>
        <tr>
            <td><?php echo $row['catgry_id'];?></td>
            <td><?php echo $row['catgry_name'];?></td>
            <td><a href="edit.php?id=<?php echo $row['catgry_id'];?>" class="btn btn-success">Edit</a> | <a href="delete.php?id=<?php echo $row['catgry_id'];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>

    
    <form method="post">
        <label>Enter Category Name: </label>
        <input type="text" class="form-control" name="txtname"/>
        <br>
        <input type="submit" class="btn btn-primary" value="Add Category" name="btnAdd"/>
    </form>
    </div>
    <?php
    include('../includes/footer.php');
    include('../includes/scripts.php')
    ?>
