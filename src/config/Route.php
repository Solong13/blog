<?php

// return [
//     '/chat1/' => function() {
//         echo "He loves";
//     },
// ];
namespace SoLong\Blog\config;

use  SoLong\Blog\Controllers\BlogController;
use  SoLong\Blog\Controllers\LoginController;
use  SoLong\Blog\Controllers\RegisterController;

class Route {

    private array $routes = [
        '/' => [BlogController::class],
        '/auth' => [RegisterController::class],
        '/login' => [LoginController::class],
        '/logout' => [LoginController::class, 'logOut'],
    ];

    public function run(){

        $uri = $_SERVER["REQUEST_URI"];

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