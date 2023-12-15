<?php

namespace SoLong\Blog\model;

use SoLong\Blog\model\con_DB;
use PDO;

class Db_reguests_with_DI {

    private $db;
    private $pdo;
    public function __construct(con_DB $db)
    {
        $this->db = $db;
        $this->pdo = $this->db->сonnectionToDataBase();
    }

    public function registerNewUser($email, $name, $password) {
        
        // Наприклад, вставити дані в таблицю
            // $stmt = $pdo->prepare('INSERT INTO your_table (column1, column2) VALUES (:column1, :column2)');
            //  $stm->bindValue('column1', 'x100@php.zone');
            // $stm->bindValue('column2', 'Вячеслав');
            // $stmt->execute(); INSERT INTO `users`(`id`, `email`, `name`, `password`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')

        $stmt = $this->pdo->prepare('INSERT INTO users (`email`, `name`, `password`) VALUES (:email, :name, :password)');
        $res = $stmt->execute([
            ':email' => $email,
            ':name' => $name,
            ':password' => $password
        ]);

        return $res ? true : false;
    }

    public function updateData($id, $data)
    {
        
        // Наприклад, оновити дані в таблиці
        $stmt = $this->pdo->prepare('UPDATE your_table SET column1 = :value1, column2 = :value2 WHERE id = :id');
        $stmt->execute([
            ':value1' => $data['value1'],
            ':value2' => $data['value2'],
            ':id' => $id,
        ]);

        
    }

    public function deleteData($id)
    {
        
        // Наприклад, видалити запис з таблиці
        $stmt = $this->pdo->prepare('DELETE FROM your_table WHERE id = :id');
        $stmt->execute([
            ':id' => $id,
        ]);
    }

    public function fetchData($login, $password)
    {
        // Наприклад, вибрати дані з таблиці
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email AND  password = :password');
        $stmt->execute([
            ':email' => $login,
            ':password' => $password,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC); //?? 'Такого користувача не існує'
    }

    public function checkEmail($email)
    {
        
        // Наприклад, вибрати дані з таблиці
        $stmt = $this->pdo->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute([
            ':email' => $email
        ]);
        return  $stmt->fetch(PDO::FETCH_ASSOC) ? $email : null;
    }

    public function checkNickName($name)
    {
        
        // Наприклад, вибрати дані з таблиці
        $stmt = $this->pdo->prepare('SELECT name FROM users WHERE name = :name');
        $stmt->execute([
            ':name' => $name
        ]);

        return  $stmt->fetch(PDO::FETCH_ASSOC) ? $name : null;
    }
    
    
    // Методи для статей
    public function getAuthorName(string $name)
    {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE name = :name');
        $stmt->execute([
            ':name' => $name
        ]);

        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }
                                    
    public function writeMessage($id, string $text){
        $stmt = $this->pdo->prepare('INSERT INTO articles (author_id, text) VALUES (:author_id, :text)');
        $res = $stmt->execute([
            ':author_id' => $id,
            ':text' => $text,
        ]);
        return $res ? true : false;
    }

    public function getMessage()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `articles` INNER JOIN `users` ON author_id = users.id');
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}