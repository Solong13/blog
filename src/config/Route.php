<?php

// return [
//     '/chat1/' => function() {
//         echo "He loves";
//     },
// ];
namespace SoLong\Blog\config;

use  SoLong\Blog\Controllers\BlogController;
use  SoLong\Blog\Controllers\LoginController;

class Route {

    private array $routes = [
        '/chat1/' => [BlogController::class],
        '/chat1/login' => [LoginController::class],
        '/chat1/logout' => [LoginController::class, 'logout'],
    ];

    public function run(){

        $uri = $_SERVER["REQUEST_URI"];
    var_dump($uri);
            if(!isset($this->routes[$uri])){
                echo 404;
                return;
            }
    
            $controller = new $this->routes[$uri][0];
            $action = $this->routes[$uri][1] ?? "currentPath";
            $controller->$action();
        
//         $session = new Session();
//         $login = $session->get('login');

//         $uri = $_SERVER['REQUEST_URI'];
// // var_dump( HOST . BASE_URL);var_dump($uri);
//         if($uri === BASE_URL."login"){
//             $login_controller = new LoginController();
//             $login_controller->currentPath();
//         }elseif($uri === BASE_URL."logout"){
//             $login_controller = new LoginController();
//             $login_controller->logExit();
//         }elseif($uri ===  BASE_URL){
//             $blog_controller = new BlogController();
//             $blog_controller->currentPath();
//         }else{
//             echo 404;
//         }
    }

}