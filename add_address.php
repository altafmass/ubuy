 <?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "connection.php";
include "function.php";
$connectObj = new database();
$con = $connectObj->connect();
$username = "";
$email = "";
$address = "";
$state_id = "";
$city_id = "";
$country_id = "";
if (isset($_POST["submit"])) {
    if (empty($_POST["username"])) {
        $user = "username is required";
    } else {
        $username = $_POST["username"];
    }
    if (empty($_POST["email"])) {
        $mail = "Email is required";
    } else {
        $email = $_POST["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail = "Invalid email format";
        }
    }
    if (empty($_POST["country_id"])) {
        $country_id_error = "country_id is required";
    } else {
        $country_id = $_POST["country_id"];
    }
    if (empty($_POST["state_id"])) {
        $state_error = "state_id is required";
    } else {
        $state_id = $_POST["state_id"];
    }
    if (empty($_POST["city_id"])) {
        $city_error = "city_id is required";
    } else {
        $city_id = $_POST["city_id"];
    }
    if (empty($_POST["address"])) {
        $add = "address is required";
    } else {
        $address = $_POST["address"];
    }
}
$abc = new state();
$data = $abc->insertdata();
$connectObj = new database();
$con = $connectObj->connect();
$add_address_state = $abc->add_addres_state();
$sql1 = "SELECT * from cities where state_id='$state_id'";
$result1 = mysqli_query($con, $sql1);
?>


<html>
   <head>
      <title>Add Address</title>
   </head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
   <!-- Latest compiled and minified JavaScript -->
   <body>
      <form method="POST" class="bg-info  p-5 w-50" style="margin-top: 2%;">
         <?php
                if (!empty($_SESSION["success_massage"])) {
                    echo $_SESSION["success_massage"];
                    unset($_SESSION["success_massage"]);
                }
                if (!empty($_SESSION["error_massage"])) {
                    echo $_SESSION["error_massage"];
                    unset($_SESSION["error_massage"]);
                }
                ?>
         <div>
            <button class="btn btn-success"> <a style="color:black;" href="index.php">Go Back</a></button>
         </div>
         <div class="ml-1 mt-4" style="width: 29%;">
            <label><b>Username</b> </label>
            <input class="form-control" type="" value="<?php echo $username; ?>" name="username" placeholder="Username">
            <span style="color: red;"><?php if (!empty($user)) {
                echo $user;
            } ?> </span>
         </div>
         <div class="ml-1 mt-4" style="width: 29%;">
            <label><b>email</b> </label>
            <input class="form-control" type="" value="<?php echo $email; ?>" name="email" placeholder="Email">
            <span style="color: red;"><?php if (!empty($mail)) {
                echo $mail;
            } ?> </span>
         </div>
         
          <div class="ml-1 mt-4" style="width: 29%;">
            <label><b>Country</b> </label>
            <?php
            $connectObj = new database();
            $con = $connectObj->connect();
            $result = mysqli_query($con, "SELECT * FROM country");
            ?>
            <select class="form-control" id="country-dropdown" name="country_id">
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
                <?php
                }
                ?>
                </select>   
                
          
         </div>

         <div class="ml-1 mt-4" style="width: 29%;">
            <label for="city"><b>State</b> </label>
            <?php
            $connectObj = new database();
            $con = $connectObj->connect();
            $result = mysqli_query($con, "SELECT * FROM state where country_id='$country_id' OR country_id='1'");
            ?>
                 <select class="form-control" id="state-dropdown" name="state_id">
                <?php
            while ($row = mysqli_fetch_array($result)) {
                $selected = "";
                if ($country_id == $row['country_id']) {
                    print_r($row);
                    $selected = 'selected = "selected"';
                }
            ?>
                                <option value="<?php echo $row['id']; ?>"<?php echo $selected; ?> ><?php echo $row["name"]; ?></option>
                <?php
                }
                ?>
                </select>   
         
            <span><?php if (!empty($state_error)) {
                echo $state_error;
            } ?> </span>
         </div><div class="ml-1 mt-4" style="width: 29%;">
            <label for="city"><b>City</b> </label>
            <?php
            $connectObj = new database();
            $con = $connectObj->connect();
            $result = mysqli_query($con, "SELECT * FROM cities where state_id='$state_id' OR state_id='1'");
            ?>
                 <select class="form-control" id="city-dropdown" name="city_id">
                <?php
            while ($row = mysqli_fetch_array($result)) {
                $selected = "";
                if ($state_id == $row['state_id']) {
                    print_r($row);
                    $selected = 'selected = "selected"';
                }
            ?>
                                <option value="<?php echo $row['id']; ?>"<?php echo $selected; ?> ><?php echo $row["name"]; ?></option>
                <?php
            }
            ?>
                </select>   
         
            <span><?php if (!empty($state_error)) {
                echo $state_error;
            } ?> </span>
         </div>
         <div class="ml-1 mt-4" style="width: 29%;">
            <label><b>address</b> </label>
            <input class="form-control" type="text" value="<?php echo $address; ?>" name="address">
            <span style="color: red;"><?php if (!empty($add)) {
                echo $add;
            } ?> </span>
         </div>
         <div class="mt-5">
            <button type="submit" name="submit" value="submit" class="btn btn-light ml-2">submit</button>
         </div>
      </form>
      </div>
      </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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