<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Places - Log In</title>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <link rel="stylesheet" type="text/css" href="public/css/login-mobile.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo1_nobg.png">
        </div>

        <div class="login-div">
            <form action="login" method="POST">
                <h1>Log in</h1>
                <?php
                    if(isset($messages))
                    {
                        foreach ($messages as $msg)
                        {
                            echo "<p>".$msg."</p>";
                        }
                    }
                ?>
                <input class="standard-input" name="login" type="text" placeholder="login or email">
                <input class="standard-input" name="password" type="password" placeholder="password">
                <button class="button-22" role="button" type="SUBMIT">log in</button>
                <a href="./regain_password">I forgot password.</a>
                <hr>
                <a href="./register">Don't have account yet? Sign in here!</a>
            </form>
        </div>
    </div>
</body>