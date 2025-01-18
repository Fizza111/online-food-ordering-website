<?php
 session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        container{
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color:  text-gray-300;
        }
        input{
            padding: 5px;
            margin: 8px;
            margin-left: 15px;
        }
        span{
            color: rgb(91, 90, 90);
        }
        #btn{
            padding: 8px;
            width: 80%;
            background-color: rgb(13, 5, 86);
            border: none;
            color: white;
        }
        #btn:active{
            background-color: rgb(25, 25, 28);
            padding: 10px;
        }
        #success{
            text-align: center;
            color: brown;
        }
    </style>
</head>
<body>
    <?php
     include'admin/connection.php';
    ?>
    <container>
        <form action="registration_process.php" method="POST">
            <h1>Sign up</h1>
            <div>
                <label>Name</label>
                <input type="text" placeholder="name" name="name">
            </div>
            <div>
                <label>Username</label>
                <input type="text" placeholder="username" name="username">
            </div>
           
            <div>
                <label>Password</label>
                <input type="password" placeholder="password" name="password">
            </div>
            <div>
                <input id="btn" type="submit" value="Submit">
            </div>
            <div>
                <span>Already registered</span> <a href="login.php">Login</a>
            </div>
        </form>
    </container>
    <p id="success" >
        <?php
        if(isset($_SESSION['success'])){
            echo "<h2 style='color:brown;text-align:center; margin-top:50px'>" .htmlspecialchars($_SESSION['success'])."</h2>";
            unset($_SESSION['success']);
        }  
        ?>
        
    </p>

</body>
</html>