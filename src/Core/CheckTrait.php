<?php

namespace SoLong\Blog\Core;

trait CheckTrait {
    
    public function has(string $key) {
        return  isset($this->serverArray[$key]);
    }

      public function get(string $key, string $default = null) {
        return $this->serverArray[$key] ?? $default;
    }
}