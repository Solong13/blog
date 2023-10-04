<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Session;
use  SoLong\Blog\Core\View;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\Post;
use  SoLong\Blog\Utils\CaptchaWrapper;

class LoginController {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function currentPath() {
        $post = new Post();
        $view = new View();
        $cookie = new Cookie();
        $captchaWrapper = new CaptchaWrapper();

        if (
            !$this->session->has('login') && 
            $post->has('user_login') && 
            $captchaWrapper->checkCaptcha($post->get("captcha"))
        ) {
            $this->session->add('login', $post->get('user_login'));
        }

        if($this->session->has('login')) {
            header("Location: ".BASE_URL);
            exit();
        }

        $view->render("login", [
            "theme" => $cookie->get("theme"),
            "captcha" => $captchaWrapper->getCaptcha()   
        ]);
    }

    public function logExit(){
        $this->session->delete('login');
        header("Location: ". HOST . BASE_URL. "login");
        exit();
    }

}