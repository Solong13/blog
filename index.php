<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'blog';
const MAINPATH = "messags.json";
const USERDB = "user_db.json";
define("ABSOLUTPATH", $_SERVER['DOCUMENT_ROOT']);
/*компоузер тепер сам сканує наші файли і підключає їх
але при загрузці компоузер очікує що всі namespace будуть розтавлені 
згідно psr-4*/
require_once('vendor/autoload.php');

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
$db = new SoLong\Blog\model\con_DB();
//var_dump($db->getPDO());
