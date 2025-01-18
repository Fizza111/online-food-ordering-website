<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "food_delivery";
   
   // Database connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
  $name=$_GET['name'];
  $delete="DeLETE FROM manage_order WHERE name='$name'";
  $data=mysqli_query($conn,$delete);
  if($data){
    ?>
     <script type="text/javascript">
         alert("data deleted successfully");
         window.open("http://localhost/final project/adminorder.php","_self");
     </script>

    <?php
  }
?>