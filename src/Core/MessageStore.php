<?php
/*
1 - Чи існує файл
2 - парсимо файл, отримання асоціативного масива
3 - додавання нового смс до асоціативного масива
4 - збереження асоціативного масива в файл
*/
namespace SoLong\Blog\Core;

use SoLong\Blog\config\init;
use SoLong\Blog\model\con_DB;
use SoLong\Blog\model\Db_reguests_with_DI;
use SoLong\Blog\config\ValidHelper;
use  SoLong\Blog\Core\Session;

class MessageStore {

    private  $message;

    // public function __construct() {
    //     if (!is_file(MAINPATH)) {
    //         file_put_contents(MAINPATH, "{}");
    //     }

    //     $this->parse();
    // }

    // public function parse(){
    //     $this->message = json_decode(file_get_contents(MAINPATH), true);
        
    // }

    public function addMessage($id, $name, $text){
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        $validHelper = new ValidHelper();
        $session = new Session();
        /*
        Виклик функції для повернення id
        Потім дод повідомлення з цим айді та вивід всіх повідомлень
        */
 
        $pdo->writeMessage($id, $text);
        
        //$this->message[] = $someText;
    }

    public function getMessages(){
        $db = new  con_DB();
        $pdo = new Db_reguests_with_DI($db);
        
        $this->message = [$pdo->getMessage()];
        return $this->message;
    }

    // public function saveMessage(){
    //     file_put_contents(MAINPATH, json_encode($this->message));
    // }

    // public function __destruct(){
    //      $this->saveMessage();
    // }
}