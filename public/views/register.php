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
                <input class="standard-input" type="email" placeholder="email" name="email">
                <input class="standard-input" type="text" placeholder="name" name="name">
                <input class="standard-input" type="text" placeholder="surname" name="surname">
                <input class="standard-input" type="password" placeholder="password" name="password">
                <input class="standard-input" type="password" placeholder="repeat password" name="repeatPassword">
                <div><p>By pressing "sign in", you confirm that you acknowledged and accepted our <a>agreement</a>.</p></div>
                <button class="button-22" role="button" type="submit">sign in</button>
            </form>
        </div>
    </div>
</body>
</html>