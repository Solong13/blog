<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\Post;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;
use SoLong\Blog\config\ValidHelper;

class RegisterController extends BaseController{
    /*
    коли заходимо відбувається перевірка 
    ввести лог і пароль і війти або зареєструватися
    тобто потрібен один контролер регістрації і можна один шаблон 
    входа-реєстрації

    Відкрив лог і пароль - ми вводимо та передаємо ініціалізовані, верефіковані дані запит до бази чи є такі дані\
    якщо ні повертаємо відпов помилку , що або лог, або пас введені не вірно
    */

    public function currentPath() {

        $cookie = new Cookie();
        $post = new Post();
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        $validHelper = new ValidHelper();

        $error = [];
        $error['error_email'] = $validHelper->validEmailBeforeRegister($post->get('email'));
        $error['error_name'] = $validHelper->validNickname($post->get('name'));
        $error['error_password'] = $validHelper->validPassword($post->get('password'));
        // ?? '' щоб не було warning
        $email = $post->get('email') ?? '';
        $name = $post->get('name') ?? '';
        $password = $post->get('password') ?? '';

        if(empty($error['error_email']) && empty($error['error_name']) && empty($error['error_password'])) {
            
            if($email && $name){
                $emailStatus = $pdo->checkEmail($post->get('email'));
                $nickNameStatus = $pdo->checkNickName($post->get('name'));
    
                if($emailStatus !== null) {
                    $error['error_email'] = "Електронна пошта зі вказаним іменем вже існує!";
                }
    
                if($nickNameStatus !== null) {
                    $error['error_name'] = "Даний нік вже існує!";
                }

                if($emailStatus === null && $nickNameStatus === null){
                    echo "Registretion SeccussefulL!";
                }
            }
        }        

        $this->SelectATemplate("auth", [
            "theme" => $cookie->get("theme"),
            "error" => $error
        ]);

    }
}
