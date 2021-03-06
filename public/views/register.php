<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Places - Sign In</title>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <link rel="stylesheet" type="text/css" href="public/css/login-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script type="text/javascript" src="./public/js/validation.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo1_nobg.png">
        </div>
        
        <div class="login-div">
            <form action="register" method="POST" enctype="application/x-www-form-urlencoded">
                <h1>Register your account</h1>
                <?php
                if(isset($messages))
                {
                    foreach ($messages as $msg)
                    {
                        echo "<p>".$msg."</p>";
                    }
                }
                ?>
                <input class="standard-input" type="text" placeholder="login" name="login">
                <p class="hide">Login needs to be between 3 and 254 characters.</p>
                <input class="standard-input" type="email" placeholder="email" name="email">
                <p class="hide">This email is invalid.</p>
                <input class="standard-input" type="text" placeholder="name" name="name">
                <p class="hide">Name is required!</p>
                <input class="standard-input" type="text" placeholder="surname" name="surname">
                <p class="hide">Surname is required!</p>
                <input class="standard-input" type="password" placeholder="password" name="password">
                <p class="hide">Password needs to be at least 8 characters.</p>
                <input class="standard-input" type="password" placeholder="repeat password" name="repeatPassword">
                <p class="hide">Passwords are not the same.</p>
                <div><p>By pressing "sign in", you confirm that you acknowledged and accepted our <a>agreement</a>.</p></div>
                <button class="button-22" role="button" type="button">sign in</button>
            </form>
        </div>
    </div>
</body>
</html>