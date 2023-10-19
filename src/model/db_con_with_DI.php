<?php
/* 
если расписать  подробнее:
1. Настройки соединения не должны быть свойствами класса. Свойство должно как-то использоваться в классе. А здесь это одноразовые переменные
2. Конкретные значения не должны прописываться в коде класса, они на всех серверах будут разные. Они должны идти из настроек
3. Никакого echo здесь быть не должно. Код соединения с БД не должен общаться напрямую с пользователем. 
4. Не говоря уже о вываливании информации об ошибке на всеобщее обозрение
5. Соответственно, try-catch тоже не нужно
И в итоге получается, что всего кода тут должно быть 2 строчки, если без получения настроек. 
$dbh = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUserName, $dbPassword);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
(кодировка тоже указывается в DSN)
*/
namespace SoLong\Blog\model;

use PDO;

class Db_con_with_DI {
    //зберігати підключення до бази даних.
    private $dbh;

    public function __construct()
    {
        $dbHost = 'localhost';
        $dbUserName = 'root';
        $dbPassword = '';
        $dbName = 'test';

        // $dbh = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUserName, $dbPassword);
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        //$this->connect();
    }

    // private function connect(){
    //     $dbHost = 'localhost';
    //     $dbUserName = 'root';
    //     $dbPassword = '';
    //     $dbName = 'test';

    //     try {
    //         //В даному рядку відбувається створення об'єкта PDO і підключення до бази даних
    //         $this->dbh = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUserName, $dbPassword);
    //         //Встановлюємо атрибути об'єкта PDO для обробки помилок і встановлюємо режим обробки помилок в режим. Вираз PDO:: вказує на те, що ця константа належить класу PDO.
    //         $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         // Задаємо кодування
    //         $this->dbh->exec('SET NAMES UTF8');
    //     } catch (PDOException $e) {
    //         echo 'Connection failed: ' . $e->getMessage();
    //     }

    // }

    public function getPDO() {
        return $this->dbh;
    }

}