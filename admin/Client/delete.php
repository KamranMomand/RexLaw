<?php
session_start();
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','','lawyers');
    if($conn)
    {
        $query="DELETE FROM `client` WHERE `cust_id`='$id'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:client.php');
        }else{
            echo "Record Not Deleted";
        }
    }
}else{
    header('location:country.php');
}

?>

