<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Session;
use  SoLong\Blog\Core\View;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\MessageStore;
use  SoLong\Blog\Core\Post;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;
use SoLong\Blog\config\ValidHelper;

class BlogController extends BaseController{

    public function currentPath() {
        $session = new Session();
        $view = new View();
        $cookie = new Cookie();
        $message_store = new MessageStore();
        $post = new Post();
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        $validHelper = new ValidHelper();
        
        $user_post = $post->get('user_post') ?? null;
        $login = $session->get('login');
        $theme = $cookie->get('theme');
        $error = [];

        if(!$session->has('login')) {
            $validHelper->redirectTo("/login");
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

                    // $message_store->addMessage([
                    //     'login' => $login,
                    //     'message' => $user_post,
                    //     'time' => time()
                    // ]);
                    $id = (int)$pdo->getAuthorName($session->get('login'));
                    $message_store->addMessage($id, $login, $post->get('user_post'));
                    //$message_store->saveMessage();
                } else {
                    $error[] = "Input the text pleas!";
                }
            }
        
        }
     
        $arr = $validHelper->createArray($message_store->getMessages());
       
        $this->SelectATemplate("blog",  [
            "theme" => $cookie->get("theme"),
            "message" => $message_store->getMessages(),
            "error" => $error,
            "login" => $login
        ]);
    }
}