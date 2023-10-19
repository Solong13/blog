<?php

namespace SoLong\Blog\Core;

use SoLong\Blog\config\init;

class View {

    public function render(string $name, array $params = []) {
        /*
        __DIR__ - це магічна константа в PHP, яка повертає абсолютний шлях до каталогу, в якому знаходиться 
        поточний PHP-скрипт. Використовуючи цю константу, ви завжди будете впевнені, що вказуєте правильний 
        абсолютний шлях до файлу незалежно від того, де розташований ваш скрипт на сервері.
        */
  
        $realPathToFile = ABSOLUTPATH."/src/Views/Templates/".$name.".php";

        if(file_exists($realPathToFile)){
            extract($params);

            require_once($realPathToFile);
        } else {
            // Обробка помилки, якщо файл не існує
            echo "Файл не існує: " . $realPathToFile;
        }
    }   

}