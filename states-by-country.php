<?php
  require_once "connection.php";
      $connectObj = new database();
    $con = $connectObj->connect();
$country_id = $_POST["country_id"];
$result = mysqli_query($con,"SELECT * FROM state where country_id = $country_id");
?>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>