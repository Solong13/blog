<?php

namespace SoLong\Blog\model;

use SoLong\Blog\model\Db_con_with_DI;
use PDO;
class Db_reguests_with_DI {

    private $db;
    
    public function __construct(Db_con_with_DI $db)
    {
        $this->db = $db;
    }

    public function registerNewUser($email, $name, $password) {
        $pdo = $this->db->getPDO();
        // Наприклад, вставити дані в таблицю
            // $stmt = $pdo->prepare('INSERT INTO your_table (column1, column2) VALUES (:column1, :column2)');
            //  $stm->bindValue('column1', 'x100@php.zone');
            // $stm->bindValue('column2', 'Вячеслав');
            // $stmt->execute(); INSERT INTO `users`(`id`, `email`, `name`, `password`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')

        $stmt = $pdo->prepare('INSERT INTO users (`email`, `name`, `password`) VALUES (:email, :name, :password)');
        $res = $stmt->execute([
            ':email' => $email,
            ':name' => $name,
            ':password' => $password
        ]);

        return $res ? true : false;
    }

    public function updateData($id, $data)
    {
        $pdo = $this->db->getPDO();
        // Наприклад, оновити дані в таблиці
        $stmt = $pdo->prepare('UPDATE your_table SET column1 = :value1, column2 = :value2 WHERE id = :id');
        $stmt->execute([
            ':value1' => $data['value1'],
            ':value2' => $data['value2'],
            ':id' => $id,
        ]);

        
    }

    public function deleteData($id)
    {
        $pdo = $this->db->getPDO();
        // Наприклад, видалити запис з таблиці
        $stmt = $pdo->prepare('DELETE FROM your_table WHERE id = :id');
        $stmt->execute([
            ':id' => $id,
        ]);
    }

    public function fetchData($login, $password)
    {
        $pdo = $this->db->getPDO();
        // Наприклад, вибрати дані з таблиці
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND  password = :password');
        $stmt->execute([
            ':email' => $login,
            ':password' => $password,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC); //?? 'Такого користувача не існує'
    }

    public function checkEmail($email)
    {
        $pdo = $this->db->getPDO();
        // Наприклад, вибрати дані з таблиці
        $stmt = $pdo->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute([
            ':email' => $email
        ]);
        return  $stmt->fetch(PDO::FETCH_ASSOC) ? $email : null;
    }

    public function checkNickName($name)
    {
        $pdo = $this->db->getPDO();
        // Наприклад, вибрати дані з таблиці
        $stmt = $pdo->prepare('SELECT name FROM users WHERE name = :name');
        $stmt->execute([
            ':name' => $name
        ]);

        return  $stmt->fetch(PDO::FETCH_ASSOC) ? $name : null;
    }    
}