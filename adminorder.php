<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders from customers</title>
</head>
<body>
<h1>The List of Orders from customers</h1>
<table width="80%" align="center" border="1">
    <tr>
        <th>Sr.No</th>
        <th>Name</th>
        <th>City</th>
        <th>Location</th>
        <th>Number</th>
        <th>Price</th>
        <th>itmes</th>
        <th>Handle Orders</th>
    </tr>
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
     $q="select * from manage_order";
     $r=mysqli_query($conn,$q);
     //print_r($r);
     
     
     $cnt=1;
     while($row=mysqli_fetch_array($r))
     {
     //print_r($row);
?>
<tr align="center">
 <td><?php echo $cnt++; ?></td>
 <td><?php echo $row['name']; ?></td>
 <td><?php echo $row['city']; ?></td>
 <td><?php echo $row['location']; ?></td>
 <td><?php echo $row['number']; ?></td>
 <td><?php echo $row['price']; ?></td>
 <td><?php echo $row['items']; ?></td>
 <td><a href="deleteorder.php?name=<?php echo $row['name']; ?>">delete</a></td>


<?php }?>
</table>
    




   


</body>
</html>