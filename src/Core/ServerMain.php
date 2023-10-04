<?php

namespace SoLong\Blog\Core;

abstract class ServerMain {
    
    protected array $serverArray;

    public function has(string $key) {
        return  isset($this->serverArray[$key]);
    }

      public function get(string $key, string $default = null) {
        return $this->serverArray[$key] ?? $default;
    }

    public function add(string $key, string $value):void {
        $this->serverArray[$key] = $value;
    }

    public function delete(string $key):void {
        unset($this->serverArray[$key]);
    }
}