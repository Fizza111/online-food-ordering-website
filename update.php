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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM food_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['food_name'];
    $price = $_POST['price'];
    $file = $_FILES['file'];

    if (!empty($file['name'])) {
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            if (file_exists($item['file_path'])) {
                unlink($item['file_path']);
            }
            $stmt = $conn->prepare("UPDATE food_items SET name = ?, price = ?, file_path = ? WHERE id = ?");
            $stmt->bind_param("sdsi", $name, $price, $filePath, $id);
        }
    } else {
        $stmt = $conn->prepare("UPDATE food_items SET name = ?, price = ? WHERE id = ?");
        $stmt->bind_param("sdi", $name, $price, $id);
    }

    $stmt->execute();
    $stmt->close();

    header("Location: food.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food Item</title>
</head>
<body>
    <h1>Update Food Item</h1>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        
        <label for="food_name">Food Name:</label>
        <input type="text" id="food_name" name="food_name" value="<?php echo $item['name']; ?>" required><br><br>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $item['price']; ?>" required><br><br>
        
        <label for="file">Upload New Image (optional):</label>
        <input type="file" id="file" name="file" accept="image/*"><br><br>
        
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
