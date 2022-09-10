<?php
class state {
    public function insertdata() {
        $mysqli = "";
        $connectObj = new database();
        $con = $connectObj->connect();
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $state_id = isset($_POST["state_id"]) ? $_POST["state_id"] : "";
        $country_id = isset($_POST["country_id"]) ? $_POST["country_id"] : "";
        $city_id = isset($_POST["city_id"]) ? $_POST["city_id"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $address = isset($_POST["address"]) ? $_POST["address"] : "";
        if (!empty($username) && !empty($state_id) && !empty($country_id) && !empty($city_id) && !empty($email) & !empty($address)) {
            $sql = "INSERT INTO `address`(`username`,`state_id`,`city_id`,`country_id`,`email`,`address`) VALUES('$username','$state_id', '$city_id','$country_id','$email','$address')";
            if (mysqli_query($con, $sql) == true) {
                $_SESSION["success_massage"] = "Data Insert Successfully";
            } else {
                $_SESSION["error_massage"] = "Error";
            }
            return $mysqli;
        }
    }
    public function displaydata() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $sql = "SELECT address.id, address.username, address.state_id, address.city_id, address.email, address.address,address.country_id,cities.name AS cities_name,state.name AS state_name,country.name AS country_name FROM `address` LEFT JOIN cities on address.city_id = cities.id LEFT JOIN state on address.state_id = state.id LEFT JOIN country on address.country_id = country.id";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function address() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $how = $_GET["id"];
        $sql = "SELECT * FROM `address` WHERE id='$how'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $state = $row["state_id"];
        $city = $row["city_id"];
        return $row;
    }
    public function address_state() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $sql = "SELECT * from state where status='Active'";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function address_city($state) {
        $connectObj = new database();
        $con = $connectObj->connect();
        $sql1 = "SELECT * from cities where state_id='$state'";
        $result1 = mysqli_query($con, $sql);
        if ($result1->num_rows > 0) {
            $row1 = [];
            while ($row = $result1->fetch_assoc()) {
                $row1[] = $row;
            }
            return $row1;
        }
    }
    public function updaterecord() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $how = $_GET["id"];
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $country_id = isset($_POST["country_id"]) ? $_POST["country_id"] : "";
        $state_id = isset($_POST["state_id"]) ? $_POST["state_id"] : "";
        $city_id = isset($_POST["city_id"]) ? $_POST["city_id"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $address = isset($_POST["address"]) ? $_POST["address"] : "";
        $sql = "UPDATE `address` SET   `username`='$username',`country_id`='$country_id', `state_id`='$state_id',`city_id`='$city_id',`email`='$email',`address`='$address' WHERE id='$how'";
        if (mysqli_query($con, $sql) == true) {
            echo "Data Update Successfully";
        } else {
            echo "Errror";
        }
    }
    public function deleterecord() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $go = isset($_GET["id"]) ? $_GET["id"] : "";
        $sql = "DELETE FROM `address` WHERE id='$go'";
        $data = mysqli_query($con, $sql);
        return $data;
    }
    public function add_addres_state() {
        $connectObj = new database();
        $con = $connectObj->connect();
        $sql = "SELECT * from state where   status='Active'";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            $add_state = [];
            while ($row = $result->fetch_assoc()) {
                $add_state[] = $row;
            }
            return $add_state;
        }
    }
    // public function address_country()
    // {
    //     $connectObj = new database();
    //     $con = $connectObj->connect();
    //     $sql_country = "SELECT * from country where status='Active'";
    //     $country_result = mysqli_query($con,$sql_country);
    //       if ($country_result->num_rows > 0) {
    //         $add_country = [];
    //         while ($row = $country_result->fetch_assoc()) {
    //             $add_country[] = $row;
    //         }
    //         return $add_country;
    //     }
    // }
    
}
