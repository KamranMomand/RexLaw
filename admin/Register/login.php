<?php
session_start();
include('../includes/header.php'); 
include '../config.php';

if(isset($_POST['login_btn']))
{
   $email=$_POST['emaill'];
   $password=$_POST['passwordd'];

   $query="select * from admin where admin_email='$email' && admin_password='$password'";
   $result=mysqli_query($conn,$query);
   if(mysqli_num_rows($result)>0)
   {
       $row=mysqli_fetch_assoc($result);
       $_SESSION['adminid']=$row['admin_id'];
       $_SESSION['adminname']=$row['admin_name'];
       header('location:../Index/index.php');
   }else
   {
       echo "<script>alert('Invalid Credentials');</script>";
   }
}



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
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
              </div>

                <form class="user"  method="POST">
                     <div class="form-group"><a style="color:black;" href="../Register/register.php">Signup Here !</a></div>
                    <div class="form-group">
                    <input type="email" name="emaill" class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="passwordd" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('../includes/scripts.php'); 
?>