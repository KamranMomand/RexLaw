<?php
session_start();
include '../config.php';



if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $s_query="Select * from services where serv_id='$id'";
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
    // $email=$_POST['txtEmail'];
    // $password=$_POST['txtPass'];
    $query = "UPDATE `services` SET `serv_name`='$name',`cat_id`='$category' where `serv_id`='$id'";
    $result=mysqli_query($conn,$query); 
    if($result)
    {
        header('location:services.php');
    }else{
        echo "Record Not Updated";
    }
}
?>
    <form method="post">
    <input type="hidden" name="txtId" value="<?php echo $s_row['serv_id']?>"/>
        <label>Enter Services Name: </label>
        <input type="text" name="txtName" value="<?php echo $s_row['serv_name']?>"/>
        <br>
        <label>Enter Category : </label>
        <select name="ddlcategory">
            <?php
                while($c_row=mysqli_fetch_assoc($c_result))
                {
                    if($s_row['cat_id']==$c_row['catgry_id'])
                    {
            ?>
                <option value="<?php echo $c_row['catgry_id'];?>" selected><?php echo $c_row['catgry_name'];?></option>
            <?php
                    }else{
                        ?>
                        <option value="<?php echo $c_row['catgry_id'];?>"><?php echo $c_row['catgry_name'];?></option>
                    <?php  
                    }}
            ?>
        </select>
        <br>
        <!-- <label>Enter Student Email: </label>
        <input type="email" name="txtEmail" value="<?php echo $s_row['se_email']?>"/>
        <br>
        <label>Enter Student Password: </label>
        <input type="password" name="txtPass" value="<?php echo $s_row['st_password']?>"/>
        <br> -->
        <input type="submit" class="btn btn-primary" value="Update Services" name="btnEdit"/>
    </form>

   














