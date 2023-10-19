<?php

namespace SoLong\Blog\model;

                          //  Спосіб Підключення до БД №1
/*
Так, PDO (PHP Data Objects) - це розширення, яке входить до складу PHP. Ви можете використовувати його без потреби 
в явному завантаженні або встановленні через Composer. По замовчуванню, воно доступне у PHP.
Однак, важливо враховувати, що ваш код повинен бути налаштований правильно, і це розширення повинно 
бути активовано у конфігураційному файлі PHP. Для роботи з базою даних із використанням PDO, ви повинні 
також встановити відповідний драйвер бази даних, який вам потрібен (наприклад, PDO MySQL, PDO SQLite і т. д.).
Ваш сервер і конфігурація PHP повинні бути налаштовані на підтримку цього розширення. Будьте обережні і переконайтеся,
 що PDO активовано і налаштовано в вашому серверному середовищі перед використанням його у своєму коді.
*/
use  PDO;

class con_DB  {
    //зберігати підключення до бази даних.
    private $dbh;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(){
        $dbHost = 'localhost';
        $dbUserName = 'root';
        $dbPassword = '';
        $dbName = 'test';

        try {
            //В даному рядку відбувається створення об'єкта PDO і підключення до бази даних
            $this->dbh = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUserName, $dbPassword);
            //Встановлюємо атрибути об'єкта PDO для обробки помилок і встановлюємо режим обробки помилок в режим. Вираз PDO:: вказує на те, що ця константа належить класу PDO.
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Задаємо кодування
            $this->dbh->exec('SET NAMES UTF8');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public function getPDO() {
        return $this->dbh;
    }
}