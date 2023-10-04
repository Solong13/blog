<?php

namespace SoLong\Blog\Core;

class Post {

    use DateTrait;
    use CheckTrait;
    public function __construct(){
        $this->serverArray = $_POST;
    }
    
}