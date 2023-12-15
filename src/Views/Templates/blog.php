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
   
            <h1>Our Messages | User: <?php print_r(  $login); ?></h1>
        </div>
        <div class="log1n">
            <a href="#">Register</a> |
            <a href="#">Log In</a> |
            <a href="/logout">Log Out</a>
        </div>
    
    </div>
    
    <?php foreach($message as $index => $mes): ?>
     <?php    
foreach($mes as $me){
        echo "<div class='message'>";
        echo "<div class='login'>" ."Автор: ". $me['name'] . "</div>";
        echo "<div class='time'>" . $me['date'] . "</div>";
        echo "<div class='login'>" . $me['title'] . "</div>";
        echo "<div class='message-text'>" . $me['text']. "</div>";
        echo "</div>";
} 
     endforeach;?>
    <form method="post">
        <input type="text" name="user_post">
         <input type="submit" value="Send">
        <p style="color:red; text-align:center;font-size: 15xp;"><?php echo $error[0] ?? null; ?></p>
    </form>

</body>
</html>