<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Session;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\Post;
use  SoLong\Blog\Utils\CaptchaWrapper;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;
use SoLong\Blog\config\ValidHelper;

class LoginController extends BaseController{

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function currentPath() {
        $post = new Post();
        $cookie = new Cookie();
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        $validHelper = new ValidHelper();
        // Помилки можна складати в $_SSESSION['validation']['name']
        $error = [];
      var_dump(isset($post->serverArray));
        if(!empty($post->serverArray)){
            $date_Form = $validHelper->dateForm($post->serverArray);
            if ($date_Form === null) {
                // Якщо не було помилок у валідації
                $date = $pdo->fetchData($post->get('user_login'), $post->get('u_password'));
                if (!$date) {
                    $error['auth'] = "Користувача за вказаними даними не існує";
                } else {
                    $this->session->add('login', $date['name']);
                }
            } else {
                // Відобразити помилки в формі
                $error['auth'] = $date_Form;
            }
        }
        
        if($this->session->has('login')) {
            $validHelper->redirectTo("/");
        }

        $this->SelectATemplate("login", ["theme" => $cookie->get("theme"),"error" => $error]);
    }

    public function logOut(){
        $validHelper = new ValidHelper(); // потрібно виправити, щоб не створювались два обєкти в одному класі
        $this->session->delete('login');
        $validHelper->redirectTo("/login");
    }

}