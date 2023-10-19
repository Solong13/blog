<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Session;
use  SoLong\Blog\Core\View;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\MessageStore;
use  SoLong\Blog\Core\Post;

class BlogController {

    public function currentPath() {
        $session = new Session();
        $view = new View();
        $cookie = new Cookie();
        $message_store = new MessageStore();
        $post = new Post();

        $user_post = $post->get('user_post') ?? null;
        $login = $session->get('login');
        $theme = $cookie->get('theme');
        $error = [];

        if(!$session->has('login')) {
            header("Location: login");
            exit;
        }
        
        if(isset($user_post) && isset($login)){
        
            if($user_post === 'dark'){
                $cookie->add('theme', 'dark');
                //setcookie('theme', 'dark');
                $theme = 'dark';
            }elseif($user_post === 'light'){
                $cookie->delete('theme');
                //setcookie('theme','', -1);
                $theme = null;
            }else{
        
                if(!empty($user_post)) {

                    $message_store->addMessage([
                        'login' => $login,
                        'message' => $user_post,
                        'time' => time()
                    ]);

                    $message_store->saveMessage();
                } else {
                    $error[] = "Input the text pleas!";
                }
            }
        
        }
        
        $view->render("blog",
            [
                "theme" => $cookie->get("theme"),
                "message" => $message_store->getMessages(),
                "error" => $error
            ]
        );
    }
}