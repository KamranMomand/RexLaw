<?php
session_start();
 
include '../config.php';

if(isset($_POST['registerbtn'])){
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $cpassword = $_POST['confirmpassword'];

    $query="INSERT INTO `admin`( `admin_name`, `admin_email`, `admin_password`) VALUES ('$username','$email','$password')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
    //    echo "Account Registered!";
       echo "<script>alert('Admin Registered!');</script>".mysqli_error($conn);
        header('location:login.php');
    }else
    {
        // echo "Failed";
        echo "<script>alert('Registered Failed Please try again');</script>";
    }
 
}
// if(isset($_POST['registerbtn']))
// {
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $confirm_password = $_POST['confirmpassword'];

//     if($password === $confirm_password)
//     {
//         $query = "INSERT INTO `admin` (`admin_name`,`admin_email`,`admin_password`) VALUES ('$username','$email','$password')";
//         $query_run = mysqli_query($connection, $query);
    
//         if($query_run)
//         {
//             echo "done".mysqli_error($connection);
//             $_SESSION['success'] =  "Admin is Added Successfully";
//             header('Location: login.php');
//         }
//         else 
//         {
//             echo "not done".mysqli_error($connection);
//             $_SESSION['status'] =  "Admin is Not Added";
//             header('Location: register.php');
//         }
//     }
//     else 
//     {
//         echo "pass no match".mysqli_error($connection);
//         $_SESSION['status'] =  "Password and Confirm Password Does not Match";
//         header('Location: register.php');
//     }

// }
 
include('../includes/header.php');

?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
       <div class="card-body p-0">
         <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register Here!</h1>
                    </div>
                    <form method="POST">

                        <div class="modal-body">

                            <div class="form-group">
                                <label> Username </label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                                <small class="error_email" style="color: red;"></small>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                            </div>
                            <button type="submit" name="registerbtn" class="btn btn-primary"> Register </button><a class="pl-3" style="color:black;" href="../Register/login.php">Already have account !</a>
                            

                        </div>
                    </form>
      </div>
  </div>
</div>
</div>
  </div>
</div>

    </div>
  </div>



<!-- <?php
// include('../includes/scripts.php'); 
?> -->
