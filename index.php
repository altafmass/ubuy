 <html>
   <head>
      <title>Address Index</title>
   </head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
   <!-- Latest compiled and minified JavaScript -->
   <body>
      <div class="container-fluid">
         <div class="row">
            <h2 style="color:black;margin-left: 10px;">Crud</h2>
         </div>
      </div>
      <!--next-->
      <div class="pt-4 pb-4 ml-3">
         <a href="add_address.php" class="btn btn-success">Add Address</a>
      </div>
      <!--next-->
      <table class="table table-hover">
         <tr>
            <th>S no.</th>
            <th>Username</th>
            <th>Country_id</th>
            <th>state_id</th>
            <th>city_id</th>
            <th>email</th>
            <th>Address</th>
            <th>Action</th>
         </tr>
         <!--loop-->
         <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            include('connection.php');
            include('function.php');
            
            
            $connectObj = new database();
            $con = $connectObj->connect();
            
            $stateObj = new state();
            $data = $stateObj->displaydata();
       
            
            foreach ($data as $value) {                  ?>
         <tr>
            <td><?php echo $value['id'];?></td>
            <td><?php echo $value['username'];?></td>
            <td><?php echo $value['country_name'];?></td>
            <td><?php echo $value['state_name'];?></td>
            <td><?php echo $value['cities_name'];?></td>
            <td><?php echo $value['email'];?></td>
            <td><?php echo $value['address'];?></td>
            <td><a href="update.php?id=<?php echo $value['id'];?>" class="btn btn-warning">Edit</a>
               <a href="delete.php?id=<?php echo $value['id'];?>" class="btn btn-danger" onclick="return confirmdata();" >Delete</a>
            </td>
         </tr>
         <?php } ?>
      </table>
      <script>
         function confirmdata(){
                  return confirm('Are you sure you want to delete this record');
              }
      </script>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </body>
</html>