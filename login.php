<?php
session_start();

if(isset($_POST['loginbtn'])){

    $email=$_POST['emaill'];
    $password=$_POST['pass'];

    include 'config.php';

    $query="select * from lawyer where email='$email' && password='$password'";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $_SESSION['lawyer_id']=$row['id'];
        $_SESSION['lawyer_name']=$row['fullname'];
        header('location:index.php');
    }else
    {
        echo "<script>alert('Invalid Credentials');</script>";
    }

}
include 'header.php';
?>

    <section id="rx-practice" class="rx-practice-section">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1000ms">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="rx-section-title headline">Login as<span> Lawyer</span></h2>
                                    </div>

                                    <form class="rx-contact-form" method="POST" >

                                        <div class="form-group">
                                            <label>Enter Your Email </label>
                                            <input type="text" name="emaill" class="form-control form-control-user" placeholder="Enter Email...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Your Password</label>
                                            <input type="password" name="pass" class="form-control form-control-user" placeholder="Enter Password...">
                                        </div>
                                        <button type="submit" name="loginbtn" class="btn btn-primary btn-user btn-block"> Login </button>
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
</section>
<?php
include 'footer.php';
?>