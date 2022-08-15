<?php
 session_start();
 
 include 'config.php';
 
 
 if(isset($_POST['signupbtn']))
 {
    $flname=$_POST['name'];
    $faname=$_POST['fname'];
    $gender=$_POST['gender'];
    $dateofbirth=$_POST['birth'];
    $qualification=$_POST['qualification'];
    // $country=$_POST['country'];
    //$state=$_POST['state'];
    // $city=$_POST['city'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $address=$_POST['address'];
    $martialstatus=$_POST['ems'];
    $association=$_POST['aba'];
    $enrollment=$_POST['enrollment'];
    $liscence=$_POST['barno'];
    $pimage=addslashes(file_get_contents($_FILES['img']['tmp_name']));

    $query="INSERT INTO `lawyer`(`fullname`, `fathername`, `gender`, `date_of_birth`, `qualification`, `profileimage`, `password`, `email`, `username`,  `address`, `martial_status`, `affiliated_bar_association`, `enrollment_year`, `bar_liscence_no`) VALUES ('$flname','$faname','$gender','$dateofbirth','$qualification','$pimage','$password','$email','$username','$address','$martialstatus','$association','$enrollment','$liscence')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
    //    echo "Account Registered!";
       echo "<script>alert('Account Registered!');</script>";
        header('location:login.php'.mysqli_error($conn));
    }else
    {
        echo "<script>alert('Invalid Credentials');</script>";
    }
 }
 include 'header.php';
?>
    <?php
    //  Country Code Start

    $conn = mysqli_connect('localhost','root','','lawyers');
    $cquery="select * from country";
    $cresult=mysqli_query($conn,$cquery);
    ?>

<script>

        $(document).ready(function(){

            $('#ctry_name').on('change', function() {
var country_id = this.value;
$.ajax({
url: "states-by-country.php",
type: "POST",
data: {
country_id: country_id
},
cache: false,
success: function(result){
$("#state_name").html(result);
$('#city_name').html('<option value="">Select State First</option>'); 
}
});
});    
$('#state_name').on('change', function() {
var state_id = this.value;
$.ajax({
url: "cities-by-state.php",
type: "POST",
data: {
state_id: state_id
},
cache: false,
success: function(result){
$("#city_name").html(result);
}
});
});

            displayData();
            function displayData()
            {
                $.ajax({
                        url:'config.php',
                        type:'GET',
                        data:{Display:1},
                        success:function(response){
                            $('#result').html(response);
                        },
                        error: function(err){
                            alert('Api Call Failed');
                        } 
                    });
            }


            $(document).on('click','.btnEdit',function(){
                var row=$(this).closest('tr').find('td');
                $('#ctry_Id').val(row[0].innerText);
                $('#ctry_name').val(row[1].innerText);
                $('#state_name').val(row[2].innerText);
                $('#city_name').val(row[3].innerText);

                $('#btnAdd').hide();
                $('#btnUpdate').show();
            });

            $(document).on('click','.btnDelete',function(){
                var id=$(this).val();
                $.ajax({
                        url:'config.php',
                        type:'POST',
                        data:{Delete:1,
                        stu_Id:id},
                        success:function(response){
                            if(response)
                            {
                                alert("Record Deleted");
                                displayData();
                            }else{
                                alert("Failed");
                            }
                        },
                        error: function(err){
                            alert('Api Call Failed');
                        } 
                    });
            });

            $('#btnAdd').click(function(){
                var cyname=$('#ctry_name').val();
                var statename=$('#state_name').val();
                var cityname=$('#city_name').val();
                
                $.ajax({
                   url:'config.php',
                   type:'POST',
                   data:{
                    Add:1,
                    coun_Name:cyname,
                    stat_name:statename,
                    cty_name:cityname
                   },
                   success:function(response)
                   {
                        if(response)
                        {
                            // alert("Record Added Successfully");
                            displayData();
                        }else{
                            alert("Failed");
                        }
                   },
                   error: function(err){
                        alert('Api Call Failed');
                   } 
                });
            });

            $('#btnUpdate').click(function(){
                var stId=$('#ctry_Id').val();
                var cyname=$('#ctry_name').val();
                var statename=$('#state_name').val();
                var cityname=$('#city_name').val();
                
                $.ajax({
                   url:'config.php',
                   type:'POST',
                   data:{
                    Update:1,
                    stu_Id:stId,
                    coun_Name:cyname,
                    stat_name:statename,
                    cty_name:cityname
                   },
                   success:function(response)
                   {
                    
                        if(response)
                        {
                            alert("Record Updated Successfully");
                            displayData();
                        }else{
                            alert("Failed");
                        }
                   },
                   error: function(err){
                        alert('Api Call Failed');
                   } 
                });
            });

        });


    </script>

<!-- // COuntry Code End -->
 <!-- ?> -->
 <br><br>
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
                                        <h2 class="rx-section-title headline">SignUp as<span> Lawyer</span></h2>
                                    </div>

                                    <form class="rx-contact-form" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Enter Full Name</label>
                                            <input type="text" name="name" class="form-control form-control-user" placeholder="Enter Full Name...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Father Name</label>
                                            <input type="text" name="fname" class="form-control form-control-user" placeholder="Enter Father Name...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Gender </label>
                                            <input type="text" name="gender" class="form-control form-control-user" placeholder="Enter Email Address...">
                                        </div> 
                                        <div class="form-group">
                                            <label>Enter Date Of Birth</label>
                                            <input type="text" name="birth" class="form-control form-control-user" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Qualification</label>
                                            <input type="text" name="qualification" class="form-control form-control-user" placeholder="Enter Qualification...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Profile Image</label>
                                            <input type="file" name="img" class="form-control form-control-user" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Password </label>
                                            <input type="text" name="password" class="form-control form-control-user" placeholder="Enter Password...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Email Address</label>
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter User Name</label>
                                        <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Username">
                                        </div>
                                        <!-- Country Code start  -->
                                        <input type="hidden" name="stId" id="ctry_Id">
                                        <label>Enter Country</label>
                                        <select class="form-control" name="country" id="ctry_name">
                                            <option>Select Country</option>
                                            <?php
                                            while($crow=mysqli_fetch_assoc($cresult))
                                            {
                                            ?>
                                            <option value="<?php echo $crow['ctry_id'];?>"><?php echo $crow['ctry_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        <br>
                                        <label>Enter State</label>
                                        <select class="form-control" name="state" id="state_name">
                                            
                                            </select>
                                        <br>
                                        <label>Enter City</label>
                                        <select class="form-control" name="city" id="city_name">
                                            
                                            </select>
                                        <br>
                                       <table class="table table-bordered table-hovered">
                                        
                                        <tbody id="result">
                                        </tbody>
                                            
                                        </table>
                                        <!-- Country Code End -->
                                        <div class="form-group">
                                            <label>Enter Address </label>
                                        <input type="text" name="address" class="form-control form-control-user" placeholder="Enter Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Martial Status</label>
                                        <input type="text" name="ems" class="form-control form-control-user" placeholder="Enter Martial Status...">
                                        </div>
                                        <div class="form-group">
                                            <label>Affiliated Bar Association</label>
                                            <input type="text" name="aba" class="form-control form-control-user" placeholder="Enter Affiliated Bar Association...">
                                        </div>
                                        <div class="form-group">
                                            <label>Enrollment Year</label>
                                            <input type="number" name="enrollment" class="form-control form-control-user" placeholder="Eter Enter Enrollment Year">
                                        </div>
                                        <div class="form-group">
                                            <label>Bar Liscence No</label>
                                            <input type="number" name="barno" class="form-control form-control-user" placeholder="Bar Liscence No">
                                        </div>
                                
                                        <button type="submit" name="signupbtn" class="btn btn-primary btn-user btn-block"> signup </button>
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
<?php include 'footer.php'; ?>