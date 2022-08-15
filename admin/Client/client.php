<?php
session_start();
include '../config.php';
include('../includes/header.php'); 
include('../includes/navbar.php');

// country Code start
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
<!-- // Country Code End -->
<?php
if(isset($_POST['btnAdd']))
{
    $Fname=$_POST['txtfname'];
    $Lname=$_POST['txtlname'];
    $Phone=$_POST['phone'];
    $CNIC=$_POST['cnic'];

    $country=$_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];

    $Street=$_POST['street'];
    $Zipcode=$_POST['zip'];
    // $fname=$_POST['txtname'];

    $cli_query = "INSERT INTO `client`( `firstName`, `lastName`, `phone`, `CNIC`, `street`, `cty_id`, `zipcode`) VALUES ('$Fname','$Lname','$Phone','$CNIC','$Street','$city','$Zipcode')";
    $cli_result=mysqli_query($conn,$cli_query);
    if($cli_result)
    {
        header('location: client.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
   
}



$query="select * from client";
$result=mysqli_query($conn,$query);

?>
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Client Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone No</th>
            <th>CNIC No</th>
            <th>Street</th>
            <th>City</th>
            <th>ZipCode</th>
            <th>Actions</th>
        </tr>
        <?php
        while($row=mysqli_fetch_array($result))
        {
        ?>
        <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[4];?></td>
            <td><?php echo $row[5];?></td>
            <td><?php echo $row[6];?></td>
            <td><?php echo $row[7];?></td>
            <td><a href="edit.php?id=<?php echo $row[0];?>" class="btn btn-success">Edit</a> | <a href="delete.php?id=<?php echo $row[0];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <form method="post">
        <label>First Name: </label>
        <input type="text" class="form-control" name="txtfname"/>
        <label>Last Name: </label>
        <input type="text" class="form-control" name="txtlname"/>
        <label>Phone No: </label>
        <input type="text" class="form-control" name="phone"/>
        <label>CNIC No: </label>
        <input type="text" class="form-control" name="cnic"/>
        <label>Street: </label>
        <input type="text" class="form-control" name="street"/>
        <!-- Country Code Start -->
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
        <!--Country Code End-->
        <label>ZipCode: </label>
        <input type="text" class="form-control" name="zip"/>
        <br>
        <input type="submit" class="btn btn-primary" value="Add Client" name="btnAdd"/>
    </form>
</div>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
?>