<?php
include 'config.php';
$state_id = $_POST["state_id"];
$result = mysqli_query($conn,"SELECT * FROM city where stat_id = $state_id");
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["city_id"];?>"><?php echo $row["city_name"];?></option>
<?php
}
?>