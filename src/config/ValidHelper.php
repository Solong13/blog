<?php

namespace SoLong\Blog\config;

use SoLong\Blog\Core\Post;

class ValidHelper {
    private $post;

    public function __construct() {
        $this->post = new Post();
    }

    // Валідація електронної пошти
    public function validEmailBeforeRegister($email){
        if(isset($email) && !empty($email)){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
                $error['error_email'] = "Адреса електронної пошти некоректний";
            }    
        } elseif (isset($email) && empty($email)){
            $error['error_email'] = "Заповніть поле email";
        }

        return $error['error_email'] ?? null;
    }

    // Валідація nickname
    public function validNickname($nickname){
        if(isset($nickname) && !empty($nickname)){
            if(mb_strlen($nickname) >= 3 && mb_strlen($nickname) <= 11){
                $name = trim($nickname);
            }else {
                $error['error_name'] = "Довжина ніка повинна бути від 3 до 11 символів";
            }
        } elseif (isset($nickname) && empty($nickname)){
            $error['error_name'] = "Заповніть поле name";
        }

        return $error['error_name'] ?? null;
    }

    public function validPassword($password){
        if(isset($password) && !empty($password)){
            if(mb_strlen($password) >= 1 && mb_strlen($password) <= 5) {
                $password = trim($password);
            }else {
                $error['error_password'] = "Задовгий пароль";
            }   
        } elseif (isset($password) && empty($password)){
            $error['error_password'] = "Заповніть поле password";
        }

        return $error['error_password'] ?? null;
    }

}
