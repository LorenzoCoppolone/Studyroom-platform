<?php
namespace Controller;
class FrontController
{
   public function run($uri)
{
    $parts = explode("/", trim($uri, "/"));

    $controllerName = $parts[1] ?? "home";
    $methodName     = $parts[2] ?? "index";
    $params         = array_slice($parts, 3);

    // Normalizza il nome del controller
    $controllerClass = ucfirst($controllerName) . "Controller";

    // Controller non trovato
    if (!class_exists($controllerClass)) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    $controller = new $controllerClass();

    // Metodo non trovato
    if (!method_exists($controller, $methodName)) {
        header("HTTP/1.1 405 Method Not Allowed");
        exit;
    }

    // Esegui il metodo con eventuali parametri
    return call_user_func_array([$controller, $methodName], $params);
}

}