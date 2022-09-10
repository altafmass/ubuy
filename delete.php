<?php 
   include('connection.php');
   include ('function.php');
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
    $connectObj = new database();
    $con = $connectObj->connect();
   
   $deleteObj = new state();
   $deletedata = $deleteObj->deleterecord();

   echo $deletedata;
   
   if($deletedata){
       header('location:index.php');
   }else{
       $message =$deletedata['message'];
   }
   ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
   alert("You are Sure Delete Record");
</script>