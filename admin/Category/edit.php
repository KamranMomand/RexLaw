<?php
session_start();
include '../config.php';

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $s_query="Select * from category where catgry_id='$id'";
    $s_result=mysqli_query($conn,$s_query);
    $s_row=mysqli_fetch_assoc($s_result);
}
$c_query="select * from category";
$c_result=mysqli_query($conn,$c_query);
if(isset($_POST['btnEdit']))
{
    $id=$_POST['txtId'];
    $name=$_POST['txtName'];
    $category=$_POST['ddlcategory'];
    $query = "UPDATE `category` SET `catgry_name`='$name' where `catgry_id`='$id'";
    $result=mysqli_query($conn,$query); 
    if($result)
    {
        header('location:category.php');
    }else{
        echo "Record Not Updated";
    }
}
include('../includes/header.php'); 
include('../includes/navbar.php');
?>
<div class="container">
    <form method="post">
    <input type="hidden" name="txtId" value="<?php echo $s_row['catgry_id']?>"/>
        <label>Enter Category Name: </label>
        <input type="text" name="txtName" class="form-control" value="<?php echo $s_row['catgry_name']?>"/>
        
        <br>
       
        <input type="submit" class="btn btn-primary" value="Update Category" name="btnEdit"/>
    </form>
</div>

    <?Php
    include('../includes/footer.php'); 
    ?>














