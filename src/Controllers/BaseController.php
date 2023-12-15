<?php

namespace SoLong\Blog\Controllers;

use  SoLong\Blog\Core\View;

class BaseController {

    public function SelectATemplate(string $path, array $params = []) {
        $view = new View();
        $view->render($path, $params);
    }


}