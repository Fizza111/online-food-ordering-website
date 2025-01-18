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

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

if (isset($_POST['upload'])) {
    $name = $_POST['food_name'];
    $price = $_POST['price'];
    $file = $_FILES['file'];

    $filePath = $uploadDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $stmt = $conn->prepare("INSERT INTO food_items (name, price, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $filePath);
        $stmt->execute();
        $stmt->close();

        header("Location: food.php");
        exit();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
