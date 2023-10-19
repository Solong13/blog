<?php

namespace SoLong\Blog\Core;

class Session {
    use CheckTrait, DateTrait;
    
    private array $serverArray;

    public function __construct(){
        if(session_status() !== PHP_SESSION_ACTIVE){
           session_start(); 
        }
        $this->serverArray = &$_SESSION;
    }

}