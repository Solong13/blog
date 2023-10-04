<?php

namespace SoLong\Blog\Core;

class Session {
    use CheckTrait, DateTrait;
    
    private array $serverArray;

    public function __construct(){
        $this->serverArray = &$_SESSION;
    }

}