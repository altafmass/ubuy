  <?php

   class database{
      private $servername = "192.168.1.63";
      private $username   = "altaf";
      private $password   = "ubuy@123";
      private $database   = "altaf_test";
      public  $con;
   

   public function connect(){
      
       $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
       if(mysqli_connect_error()) {
        trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
       }else{
       return $this->con;
       }   

   } 
        
 }

?>