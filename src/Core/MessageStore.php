<?php
/*
1 - Чи існує файл
2 - парсимо файл, отримання асоціативного масива
3 - додавання нового смс до асоціативного масива
4 - збереження асоціативного масива в файл
*/
namespace SoLong\Blog\Core;

class MessageStore {

    private array $message;

    public function __construct() {
        if(!is_file(MAINPATH)){
            file_put_contents(MAINPATH, "{}");
        }

        $this->parse();
    }

    public function parse(){
        $this->message = json_decode(file_get_contents(MAINPATH), true);
    }

    public function addMessage(array $someText){
        $this->message[] = $someText;
    }

    public function getMessages(){
        return $this->message;
    }

    public function saveMessage(){
        file_put_contents(MAINPATH, json_encode($this->message));
    }

    public function __destruct(){
        $this->saveMessage();
    }
}