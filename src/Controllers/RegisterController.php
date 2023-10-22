<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\View;
use  SoLong\Blog\Core\Cookie;
use  SoLong\Blog\Core\Post;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;
use SoLong\Blog\config\ValidHelper;

class RegisterController {
    /*
    коли заходимо відбувається перевірка 
    ввести лог і пароль і війти або зареєструватися
    тобто потрібен один контролер регістрації і можна один шаблон 
    входа-реєстрації

    Відкрив лог і пароль - ми вводимо та передаємо ініціалізовані, верефіковані дані запит до бази чи є такі дані\
    якщо ні повертаємо відпов помилку , що або лог, або пас введені не вірно
    */

    public function currentPath() {

        $view = new View();
        $cookie = new Cookie();
        $post = new Post();
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        $validHelper = new ValidHelper();

        $error = [];
        $error['error_email'] = $validHelper->validEmailBeforeRegister($post->get('email'));
        $error['error_name'] = $validHelper->validNickname($post->get('name'));
        $error['error_password'] = $validHelper->validPassword($post->get('password'));

        $email = $post->get('email');
        $name = $post->get('name');
        $password = $post->get('password');

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
                    var_dump($pdo->registerNewUser($email, $name, $password));
                    echo "Registretion SeccussefulL!";
                }
            }
        }        

        var_dump($name);
        var_dump($error);

        $view->render("auth", [
            "theme" => $cookie->get("theme"),
            "error" => $error
            //"captcha" => $captchaWrapper->getCaptcha() ?? null
        ]);
    }
}
// Обробка помилок і повідомлення користувачам можуть бути покращені за допомогою використання винятків (exceptions) та звичайних повідомлень. Ось приклад, як ви можете здійснити це в вашому контролері:

// Визначте спеціальні класи винятків: Ваш контролер може мати власні класи винятків для різних видів помилок. Наприклад:

// php
// Copy code
// class EmailAlreadyExistsException extends \Exception {}
// class NicknameAlreadyExistsException extends \Exception {}
// class ValidationException extends \Exception {}
// Обробка помилок: При виникненні помилки створюйте відповідний об'єкт винятка та кидаєте його. Наприклад:

// php
// Copy code
// if ($emailStatus !== null) {
//     throw new EmailAlreadyExistsException("Електронна пошта зі вказаним іменем вже існує!");
// }

// if ($nickNameStatus !== null) {
//     throw new NicknameAlreadyExistsException("Даний нік вже існує!");
// }
// Обробка винятків: Ваш контролер повинен мати обробник винятків, який ловить винятки та надсилає їх на сторінку з повідомленнями про помилки для користувача. Ось приклад такого обробника в контролері:

// php
// Copy code
// try {
//     // Ваша логіка реєстрації
// } catch (EmailAlreadyExistsException $e) {
//     $error['error_email'] = $e->getMessage();
// } catch (NicknameAlreadyExistsException $e) {
//     $error['error_name'] = $e->getMessage();
// } catch (ValidationException $e) {
//     // Обробка валідаційних помилок
// }
// Виведення повідомлень користувачам: У вашому представленні (шаблоні) виведіть ці повідомлення про помилки для користувача. Ви можете використовувати звичайні засоби HTML та CSS для стилізації повідомлень.