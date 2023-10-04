<?php
/*
Запис І Імен окремо 
хоча це реалізовано і в повідомленнях
тобто вивід можна робити лише тих повідомлень які співпадають
із введеним ніком

Тобто кожен юзер може бачити своє повідомлення
можна бачити всі повідомлення
вхід вихід
редагування
*/
class Users {

    private array $serverArray;

    public function __construct(){
        if(!is_file(USERDB)){
            file_put_contents(USERDB, "{}");
        }

        $this->serverArray = &$_SESSION;
    }

    public function registerNewUser($key , $value){
        $this->serverArray[$key] = $value;
    }

    public function parsseUsers(){
        $this->serverArray = json_decode(file_get_contents(USERDB), true);
    }

    public function addUser(){
        $this->serverArray[] = $serverArray;
    }    

    public function __destruct(){
        file_put_contents(USERDB, json_encode($this->serverArray));
    }

    public function get(){
        return $this->serverArray;
    }    

}