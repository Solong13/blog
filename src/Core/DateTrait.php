<?php

namespace SoLong\Blog\Core;

trait DateTrait {
    public function add(string $key, string $value):void {
        $this->serverArray[$key] = $value;
    }

    public function delete(string $key):void {
        unset( $this->serverArray[$key]);
    }
}