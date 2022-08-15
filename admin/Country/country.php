<?php
session_start();
include 'config.php';
include('../includes/header.php'); 
include('../includes/navbar.php'); 
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
<button id="btnAdd" class="btn btn-success">Add Country</button>
<button id="btnUpdate" class="btn btn-success" style="display: none;">Update Country</button>
<table class="table table-bordered table-hovered">
<thead>    
<tr>
        <th>Country Id</th>
        <th>Country Name</th>
        <th>Action</th>
    </tr>
</thead>
<tbody id="result">

</tbody>
    
</table>
<?php
include('../includes/footer.php');
?>