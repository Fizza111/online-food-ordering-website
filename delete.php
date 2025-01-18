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

    $stmt = $conn->prepare("SELECT file_path FROM food_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if ($item) {
        $filePath = $item['file_path'];

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $stmt = $conn->prepare("DELETE FROM food_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: food.php");
exit();
?>
