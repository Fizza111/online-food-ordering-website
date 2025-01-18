<?php
    include('admin/connection.php');

    // Check if the session is already started
    if (!isset($_SESSION)) {
        session_start();
    }

    $name = $_REQUEST['username'];
    $ps = $_REQUEST['password'];

    // Check if the username and password are for the admin
    if ($name == 'admin' && $ps == '1234') {
        $_SESSION['login'] = $name;
        header('location:admin/adminhome.php');
        exit;
    }

    // Prepare the SQL query
    $q = "SELECT * FROM register WHERE username = ? AND password = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $q);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $name, $ps);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['msg'] = 'Login Credential Fail';
        header('location:login.php');
        exit;
    } else {
        $_SESSION['login'] = $name;
        header('location:client.php');
        exit;
    }
?>