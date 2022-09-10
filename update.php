<?php
include "connection.php";
include "function.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$is_valid = true;
$connectObj = new database();
$con = $connectObj->connect();
$updateObj = new state();
$row = $updateObj->address();
$address_name = isset($row["username"]) ? $row["username"] : "";
$address_email = isset($row["email"]) ? $row["email"] : "";
$addres_data = isset($row["address"]) ? $row["address"] : "";
$addres_state_id = isset($row["state_id"]) ? $row["state_id"] : "";
$addres_city_id = isset($row["city_id"]) ? $row["city_id"] : "";
$addres_country_id = isset($row["country_id"]) ? $row["country_id"] : "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_valid = true;
    if (empty($_POST["username"]) || $_POST["username"] == "") {
        $is_valid = false;
        $error = "username fild is empty";
        $address_name = "";
    } else {
        $address_name = $_POST["username"];
    }
    if (empty($_POST["email"]) || $_POST["email"] == "") {
        $is_valid = false;
        $email_error = "email fild is empty";
        $address_email = "";
    } else {
        $address_email = $_POST["email"];
        if (!filter_var($address_email, FILTER_VALIDATE_EMAIL)) {
            $is_valid = false;
            $email_error = "Invalid email format";
        }
    }
    if (empty($_POST["address"]) || $_POST["address"] == "") {
        $is_valid = false;
        $address_error = "address fild is empty";
        $addres_data = "";
    } else {
        $addres_data = $_POST["address"];
    }
    if (empty($_POST["state_id"]) || $_POST["state_id"] == "") {
        $is_valid = false;
        $state_id_error = "state_id fild is empty";
        $addres_state_id = "";
    } else {
        $addres_state_id = $_POST["state_id"];
    }
    if (empty($_POST["city_id"]) || $_POST["city_id"] == "") {
        $is_valid = false;
        $city_id_error = "city_id fild is empty";
        $addres_city_id = "";
    } else {
        $addres_city_id = $_POST["city_id"];
    }
    if (empty($_POST["country_id"]) || $_POST["country_id"] == "") {
        $is_valid = false;
        $country_id_error = "country_id fild is empty";
        $addres_country_id = "";
    } else {
        $addres_country_id = $_POST["country_id"];
    }
    if ($is_valid) {
        $updateObj = new state();
        $updatedata = $updateObj->updaterecord();
    }
}

?>
<html>
   <head>
      <title>Edit</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
   </head>
   <body>
      <div style="display: flex;align-items: center;justify-content: center;">
         <form class="bg-info w-50 p-5 mt-5" method="post" id="form">
            <div>
               <button class="btn btn-success"> <a style="color:black;" href="index.php">Go Back</a></button>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="username"  placeholder="Name" value="<?php echo $address_name; ?>">
                        <span style="color:red;">
                         <?php if (!empty($error)) {
                            echo $error;
                        } ?>
                        </span>
                     </div>
                     <div class="form-group">
                        <label>Country</label>
                       <select class="form-control" id="country-dropdown" name="country_id">
                     <?php
                    $connectObj = new database();
                    $con = $connectObj->connect();
                    $result = mysqli_query($con, "SELECT * FROM country");
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                <option value="<?php echo $row['id']; ?>"<?php if ($row['id'] == $addres_country_id) echo 'selected="selected"'; ?>><?php echo $row["name"]; ?></option>
                <?php
                    }
                    ?>
                </select>   
                     </div>

                     <div class="form-group">
                        <label>State_id</label>
                      <select class="form-control" id="state-dropdown" name="state_id">
                         <?php
                        $connectObj = new database();
                        $con = $connectObj->connect();
                        $result = mysqli_query($con, "SELECT * FROM state where country_id = '$addres_country_id'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                   <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $addres_state_id) echo 'selected="selected"'; ?>><?php echo $row["name"]; ?></option>
                   <?php
                    }
                    ?>
                   </select> 
                        <span style="color:red;">
                        <?php if (!empty($state_error)) {
                        echo $state_error;
                    } ?>
                        </span>
                     </div>
                     <div class="form-group">
                        <label>City_id</label>
                       <select class="form-control" id="city-dropdown" name="city_id">
                                 <?php
                    $connectObj = new database();
                    $con = $connectObj->connect();
                    $result = mysqli_query($con, "SELECT * FROM cities  where state_id='$addres_state_id'");
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $addres_city_id) echo 'selected="selected"'; ?>><?php echo $row["name"]; ?></option>
                   <?php
                    }
                    ?>

                       </select>
                        <span style="color:red;"> <?php if (!empty($city_error)) {
                        echo $city_error;
                    } ?> </span> 
                     </div>
                     <div class="form-group">
                      <label>Email</label>
                      
                        <input class="form-control" type="text"
                           name="email"  placeholder="email"
                           value="<?php echo $address_email; ?>"> 

                           <span
                           style="color:red;"> <?php if (!empty($email_error)) {
                            echo $email_error;
                        } ?>
                        </span> 
                     </div>
                     <div class="form-group">
                        <label>Address</label> 
                        <input class="form-control" type="text" name="address"  placeholder="address" value="<?php echo $addres_data; ?>"> <span style="color:red;"> <?php if (!empty($address_error)) {
                            echo $address_error;
                        } ?>
                            </span> 
                     </div>
                     <div>
                        <input class="btn btn-warning" type="submit"
                           name="update" value="Update"> 
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </body>
</html>
<script>$(document).ready(function() {
$('#country-dropdown').on('change', function() {
var country_id = this.value;
$.ajax({
url: "states-by-country.php",
type: "POST",
data: {
country_id: country_id
},
cache: false,
success: function(result){
$("#state-dropdown").html(result);
$('#city-dropdown').html(); 
}
});
});    
$('#state-dropdown').on('change', function() {
var state_id = this.value;
$.ajax({
url: "cities-by-state.php",
type: "POST",
data: {
state_id: state_id
},
cache: false,
success: function(result){
$("#city-dropdown").html(result);
}
});
});
});
</script>
