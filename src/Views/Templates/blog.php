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
    
    <?php 
var_dump($message);
        foreach($message as $mes){
           // if($session->get('login', null) === $mes['login']){
                echo "<div class='message'>";
                echo "<div class='time'>" . date('d.m.y H:i' , $mes['time']) . "</div>";
                echo "<div class='login'>" . $mes['login'] . "</div>";
                echo "<div class='message-text'>" . $mes['message']. "</div>";
                echo "</div>";
           // }
        
        }
    ?>

    <form method="post">
        <input type="text" name="user_post">
        <input type="submit" value="Send">
        <p style="color:red; text-align:center;font-size: 15xp;"><?php echo $error[0] ?? null; ?></p>
    </form>

</body>
</html>