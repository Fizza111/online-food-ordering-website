<?php
 session_start();
 include "admin/connection.php";
 $name=$_REQUEST['name'];
 $username=$_REQUEST['username'];
 
 $password=$_REQUEST['password'];
 $checkquery="select * from register where username='$username'";
 $checkresult=mysqli_query($con,$checkquery) ;
 if(mysqli_num_rows($checkresult)>0){
  $_SESSION['error']="Username already exist";
  header("Location:register.php");
  exit();
 }
 else{
 
 $q="insert into register(username,password,name) VALUES('$username','$password','$name')";
 $result=mysqli_query($con,$q);
 if(!$result){
    echo "Error inserting" .mysqli_error($con);
 }
 else{
   $_SESSION['success']="You have created your account";
   header("Location:register.php");
   exit();
 }

}

?>