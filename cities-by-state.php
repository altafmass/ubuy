<?php
  require_once "connection.php";
    $connectObj = new database();
    $con = $connectObj->connect();
    
$state_id = $_POST["state_id"];
$result = mysqli_query($con,"SELECT * FROM cities where state_id = $state_id");

?>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}