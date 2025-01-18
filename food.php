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
    <title>Admin: Food Upload</title>
</head>
<body>
    <h1>Upload Food Items</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <label for="food_name">Food Name:</label>
        <input type="text" id="food_name" name="food_name" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="file">Upload Image:</label>
        <input type="file" id="file" name="file" accept="image/*" required><br><br>

        <button type="submit" name="upload">Upload</button>
    </form>
    <hr>
    <h2>Uploaded Items</h2>
    <div>
        <?php
        $result = $conn->query("SELECT * FROM food_items ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>
                        <img src='{$row['file_path']}' alt='{$row['name']}' width='100'>
                        <p>Name: {$row['name']}</p>
                        <p>Price: {$row['price']}</p>
                        <a href='update.php?id={$row['id']}'>Update</a>
                        <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                      </div><hr>";
            }
        } else {
            echo "<p>No items uploaded yet.</p>";
        }
        ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
