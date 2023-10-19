<?php

namespace SoLong\Blog\Core;

class Cookie {

    use CheckTrait;
    use DateTrait {
        add as addTrait;
        delete as deleteTrait;
    }

    private array $serverArray;

    public function __construct(){
        $this->serverArray = $_COOKIE;
    }

    public function add( string $key, string $value):void {
        setcookie($key, $value);
        $this->addTrait($key, $value);
    }

    public function delete(string $key):void {
        setcookie($key, '', -1);
        $this->deleteTrait($key);
    }
}