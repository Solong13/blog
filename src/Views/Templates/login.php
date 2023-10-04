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
            <a href="#">Log In</a>
        </div>
    
    </div>

        <form class="form_login" method="post">
            <input type="text" name="user_login"> 
            <input type="submit" value="Login">
            <img class="captcha" src="<?php echo $captcha; ?>">
            <input class="value_captcha" type="text" name="captcha">
            
        </form>

</body>
</html>