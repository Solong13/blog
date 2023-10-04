<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

session_start();
const MAINPATH = "messags.json";
const USERDB = "user_db.json";
const BASE_URL = '/chat1/';
const HOST = 'http://test';
/*компоузер тепер сам сканує наші файли і підключає їх
але при загрузці компоузер очікує що всі namespace будуть розтавлені 
згідно psr-4*/
require_once('vendor/autoload.php');



// require_once('User.php');
// require_once('src/Core/CheckTrait.php');
// require_once('src/Core/DateTrait.php');
// require_once('src/Core/Cookie.php');
// require_once('src/Core/Session.php');
// require_once('src/Views/View.php');
// require_once('src/Core/MessageStore.php');
// require_once('config/Route.php');
// require_once('src/Controllers/LoginController.php');
// require_once('src/Controllers/BlogController.php');
// require_once('src/Core/Post.php');

// $routers = require_once('config/Route.php');
// $uri = $_SERVER["REQUEST_URI"];
// var_dump($uri);
// if (isset($routers[$uri])) {
//     $routers[$uri]();
// } else {
//     echo "Route not found";
// }

$route = new SoLong\Blog\config\Route();
$route->run();
