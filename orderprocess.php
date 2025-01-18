


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
 mysqli_select_db($conn,'food_delivery');

$name = $_REQUEST['name'];
 $city = $_REQUEST['city']; 
 $location = $_REQUEST['location'];
  $number = $_REQUEST['number']; 
  $items = $_REQUEST['selected_items'];
  $totalprice = $_REQUEST['totalPrice']; 
  $q="insert into manage_order(name,city,location,number,price,items) VALUES('$name','$city','$location','$number','$totalprice','$items')"; 
  $result=mysqli_query($conn,$q); 
  if(!$result){ echo "Error inserting" .mysqli_error($con); } 
  else{ $_SESSION['success']="You have created your order";
     header("Location:uorder.php"); 
     exit(); }

     ?>