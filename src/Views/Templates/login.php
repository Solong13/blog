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
            <h1>Enter</h1>
        </div>
        <div class="log1n">
            <a href="/auth">Register</a> |
            <a href="/login">Log In</a> |
            <a href="/logout">Log Out</a>
        </div>
    
    </div>

<form class="form_login" method="post">
        <!-- <label for="user_login">Input Login:</label> -->
        <input type="text" placeholder="Input your email:" name="user_login" id="user_login" require>

        <!-- <label for="u_password">Input Password:</label> -->
        <input type="password" placeholder="Input your password:" name="u_password" id="u_password" require>
    
         <input type="submit" value="Log In">
        <p style="color:red; text-align:center; margin-top: 55px; font-size: 15xp;"><?php echo $error["auth"] ?? null; ?></p>
</form>


</body>
</html>