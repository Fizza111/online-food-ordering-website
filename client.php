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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="src/output.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .food-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .food-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: calc(33.33% - 40px); /* Three items per row with gap */
            box-sizing: border-box;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .food-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        

        .food-item img {
         display: block; /* Treat the image as a block-level element */
          margin: 0 auto; /* Center the image horizontally */
        max-width: 100%;
         height: auto;
          border-radius: 8px;
          }
        .food-item h3 {
            margin: 15px 0 10px;
            font-size: 1.2em;
            color: #333;
        }
        .food-item p {
            margin: 0 0 15px;
            font-size: 1em;
            color: #666;
        }
        .order-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .order-button:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            .food-item {
                width: calc(50% - 20px); /* Two items per row on smaller screens */
            }
        }
        @media (max-width: 480px) {
            .food-item {
                width: 100%; /* One item per row on very small screens */
            }
        }
    </style>
</head>
<body>
<header id="header"></header>
    <script>
        fetch('header.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header').innerHTML = data;
            });
    </script>
   


    <h1>Available Food Items</h1>
    <div class="food-container">
    <?php
    // Fetching all the food items from the database
    $result = $conn->query("SELECT * FROM food_items ORDER BY created_at DESC");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='food-item'>
                    <img src='{$row['file_path']}' alt='{$row['name']}' width='150'>
                    <h3>{$row['name']}</h3>
                    <p>Price: Rs.{$row['price']}</p>
                    <button class='order-button' onclick='window.location.href=\"uorder.php?id={$row['id']}\";'>Order Now</button>
                  </div>";
        }
    } else {
        echo "<p>No food items available at the moment.</p>";
    }
    ?>
</div>
    

    

    <script>
       function orderItem(itemId) {
    alert("Order placed for item ID: " + itemId);
    // Redirect to order.php with the ID as a query parameter
    window.location.href = "uorder.php?id=" + itemId;
     }
    </script>

<footer id="footer"></footer>
<script>
 fetch('footer.html')
     .then(response => response.text())
     .then(data => {
         document.getElementById('footer').innerHTML = data;
     });
</script>


</body>
</html>

<?php $conn->close(); ?>