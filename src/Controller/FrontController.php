<?php
namespace Controller;
use Controller\HomeController;
class FrontController
{
  public function run($uri)
{
    $parts = explode('/', trim(explode('?', $uri)[0], '/'));
    if(strtolower($parts[0]) === "studyroom-platform") array_shift($parts);
    $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : "Home";
    if (isset($parts[1]) && is_numeric($parts[1])) {
        $metodo = "mostra";                  // es: materiale/2
        $params = array_slice($parts, 1);    // params = [2]
    } else {
        $metodo = $parts[1] ?? "index"; // es: materiale/preferito/3
        $params = array_slice($parts, 2);    // params = [3]
    }
    $controllerClass = "Controller\\" . $controllerName . "Controller";
    if (!class_exists($controllerClass)) { header("HTTP/1.1 404 Not Found");        exit; }
    $controller = new $controllerClass();
    if (!method_exists($controller, $metodo)) { header("HTTP/1.1 405 Method Not Allowed"); exit; }
    return call_user_func_array([$controller, $metodo], $params);
}
}