<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-8">Your Order</h1>

        <?php
        session_start();

        if (!isset($_SESSION['selected_items'])) {
            $_SESSION['selected_items'] = [];
        }

        if (isset($_GET['id'])) {
            $itemId = intval($_GET['id']);
            $conn = new mysqli("localhost", "root", "", "food_delivery");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM food_items WHERE id = $itemId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['selected_items'][$itemId] = $row;
            } else {
                echo "Item not found.";
            }

            $conn->close();
        }

        if (isset($_GET['remove'])) {
            $removeId = intval($_GET['remove']);
            if (isset($_SESSION['selected_items'][$removeId])) {
                unset($_SESSION['selected_items'][$removeId]);
            }
            header("Location: uorder.php");
            exit();
        }

        $totalPrice = 0;
        $selectedItemsNames = [];
        if (!empty($_SESSION['selected_items'])) {
            foreach ($_SESSION['selected_items'] as $item) {
                $totalPrice += $item['price'];
                $selectedItemsNames[] = $item['name'];
            }
        }

        echo '<p ><a href="client.php"><span class="font-bold px-4">Explore more <i class="fa-solid fa-arrow-right"></i></span></i></a></p>';
        if (!empty($_SESSION['selected_items'])) {
            echo "<div class='grid grid-cols-1 md: cols-3 gap-6 mb-8'>";
            foreach ($_SESSION['selected_items'] as $itemId => $item) {
                echo "<div class='bg-white p-6 rounded-lg shadow-md flex items-center'>";
                echo "<img src='" . $item['file_path'] . "' alt='" . $item['name'] . "' class='w-20 h-20 object-cover rounded-md mr-4  px-3'>";
                echo "<div>";
                echo "<p class='text-lg font-semibold'>" . $item['name'] . "</p>";
                echo "<p class='text-gray-600'>Rs." . $item['price'] . "</p>";
                echo "<form method='get' action='' class='mt-4 text-gray-600' onsubmit=\"return confirm('Are you sure you want to remove this item?');\">";
                echo "<input type='hidden' name='remove' value='remove" . $itemId . "'>";
                echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600'>Remove</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p class='text-gray-600'>No items selected.</p>";
        }
        ?>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-center">Order Details</h2>
            <form class="space-y-6" action="orderprocess.php" method="POST">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">City name</label>
                    <div class="mt-1">
                        <input type="text" name="city" id="city" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <div class="mt-1">
                        <input type="text" name="location" id="location" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone number</label>
                    <div class="mt-1">
                        <input type="text" name="number" id="number" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Selected Items</label>
                    <div class="mt-1">
                        <input type="text" name="selected_items" id="selected_items" value="<?php echo implode(', ', $selectedItemsNames); ?>" readonly class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium text-gray-700">Total Price</label>
                    <p id="totalPrice" class="text-lg font-semibold"><?php echo $totalPrice; ?>/-</p>
                </div>
                <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">

                <div>
                    <button type="submit" class="w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800">Submit</button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                Cash on delivery
            </p>
        </div>
    </div>
</body>
</html>