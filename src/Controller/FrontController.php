<?php
namespace Controller;
use Controller\HomeController;
class FrontController
{
   public function run($uri)

{
    // 1. Rimuove la query string
    $uri = explode('?', $uri)[0];

    // 2. Divide in parti
    $parts = explode('/', trim($uri, '/'));

    // 3. Controller e metodo
    $controllerName = !empty($parts[0]) ? $parts[0] : "Home";
    $metodo         = $parts[1] ?? "mostraHome";
    // 4. Parametri aggiuntivi
    $params = array_slice($parts, 2);

    // 5. Costruzione classe
    $controllerClass = "Controller\\" . ucfirst($controllerName) . "Controller";

    // 6. Controller non trovato
    if (!class_exists($controllerClass)) {
        exit;
    }

    $controller = new $controllerClass();

    // 7. Metodo non trovato
    if (!method_exists($controller, $metodo)) {
        header("HTTP/1.1 405 Method Not Allowed");
        exit;
    }

    // 8. Esegui il metodo
    return call_user_func_array([$controller, $metodo], $params);
}


}