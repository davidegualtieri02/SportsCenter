<?php

class CFrontController {
    public function run($requestUri) {
        $requestUri = trim($requestUri, '/');
        $uriParts = explode('/', $requestUri);
        array_shift($uriParts);
        $nomeController = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'Utente';
        $nomeMetodo = !empty($uriParts[1]) ? $uriParts[1] : 'index';
        $classeController = 'C'.$nomeController;
        $fileController = __DIR__."/{$classeController}.php";

        //echo "Request URI: $requestUri<br>";
        //echo "Controller: $classeController<br>";
        //echo "Method: $nomeMetodo<br>";
        //echo "File path: $fileController<br>";

        if (file_exists($fileController)) {
            require_once($fileController);
            if(method_exists($classeController, $nomeMetodo)) {
                $params = array_slice($uriParts, 2);
                call_user_func_array([$classeController, $nomeMetodo], $params);
            } else {
                echo "Method $nomeMetodo not found in class $classeController.<br>";
                //header('Location: https://www.facebook.com/');
            }
        } else {
            echo "File $fileController does not exist.<br>";
            //header('Location: https://www.google.it/');
        }
    }
}
