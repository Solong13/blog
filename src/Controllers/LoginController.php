<?php
/*
1) При введені логіна і пароля повинна викликатися функція із перевіркою таких даних в бд та повертати результат,
якщо такого немає перенаправлять на реєстрацію або видавати помилку та запропонувати реєстрацію, або зайти в акаунт, якщо дані є в бд

1) якщо логін і пароль немає пишемо такого користувача не знайдено
2) якщо є збергіаємо дані лог і пароль в сесії
валідація, як окремий клас для даних які вводяться в форму та передаються в запиті до бд
helper як редірект функція
*/
namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Session;
use  SoLong\Blog\Core\View;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\Post;
use  SoLong\Blog\Utils\CaptchaWrapper;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;

class LoginController {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function currentPath() {
        $post = new Post();
        $view = new View();
        $cookie = new Cookie();
        $db = new  con_DB();
       $pdo = new Db_reguests_with_DI($db);
        $error = [];
        //$captchaWrapper = new CaptchaWrapper();

       // var_dump();
  
        if($post->has('user_login') && $post->has('u_password')){ 
            $date = $pdo->fetchData($post->get('user_login'), $post->get('u_password'));
            
            if(!$date) {
                $error['auth'] = "Користувача за вказаними даними не існує";
            } else {
                $name = $pdo->getName($post->get('user_login'));
                $this->session->add('login', $name['name']);
            }
        }

        if($this->session->has('login')) {
            header("Location: ".HOST);
            exit();
        }

        $view->render("login", [
            "theme" => $cookie->get("theme"),
            "error" => $error
            //"captcha" => $captchaWrapper->getCaptcha() ?? null
        ]);
    }

    public function logOut(){
        $this->session->delete('login');
        header("Location: ". HOST . "login");
        exit();
    }

}