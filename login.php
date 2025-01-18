<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form{
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 50px;
            border-radius: 8px;
            background-color: text-gray-300;
        }
        div{
            display: flex;
            margin: 20px;
            
        }
        input{
            padding: 5px;
            margin: 2px;
            margin-left: 10px;
        }
        h1{
            margin-bottom: 20px;
        }
        span{
            color: rgb(96, 95, 95);
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
    </style>
</head>
<body>
    <container>
        
        <form action="login_process.php" method="POST">
            <h1>Sign in</h1>
            <div>
                <p>Username</p>
                <input type="text" name="username" placeholder="username" required>
            </div>
            <div>
                <p>Password</p>
                <input type="password" name="password" placeholder="password" autocomplete="off" required>
            </div>
            <div>
                <input id="btn" type="submit" value="Login">
            </div>
            <div>
                <span>No Account</span><a href="register.php"> Create account</a>
            </div>

        </form>
    </container>
</body>
</html>