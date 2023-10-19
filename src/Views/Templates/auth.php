<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($theme === 'dark') ?  'style-night.css' : 'style.css';?>">
    <title>Blog</title>
</head>
<body>
    <div class="hed">
        <div>
            <h1>Our Messages</h1>
        </div>
        <div class="log1n">
            <a href="login">Log In</a>
        </div>
    
    </div>

        <form class="form_login" method="post">
        <p style="color:red; text-align:center;font-size: 15xp;"><?php echo $error["error_email"] ?? null; ?></p>
        <p style="color:red; text-align:center;font-size: 15xp;"><?php echo $error["error_name"] ?? null; ?></p>
        <p style="color:red; text-align:center;font-size: 15xp;"><?php echo $error["error_password"] ?? null; ?></p>
            <input style="margin: 0 5px 10px 0; float: left;
    width: 89%;
    padding: 5px;
    border-radius: 50px;
    border-color: aquamarine;
    background: beige;" placeholder="email" type="email" name="email" require>
            
            <input type="text" placeholder="nick_name" name="name" require>
            <input type="password" placeholder="password" name="password" require>
            <input type="submit" value="Register">
            
            <!-- <img class="captcha" src="<?php //echo $captcha ?? null; ?>"> -->
            <!-- <input class="value_captcha" type="text" name="captcha"> -->
        </form>

</body>
</html>