<?php
namespace Controller;

/**
 * FrontController
 *
 * Gestisce il routing principale dell’applicazione:
 * - Estrae controller, metodo e parametri dall’URI
 * - Verifica l’esistenza del controller e del metodo
 * - Esegue la chiamata dinamica
 */
class FrontController {
    
    /**
     * Analizza l'URI e instrada la richiesta al controller corretto.
     *
     * @param string $uri URI richiesta dall’utente
     * @return void
     */
    public function run(string $uri): void {
        
        /** -------------------------------------------------------------
         * 1. NORMALIZZAZIONE URI
         * --------------------------------------------------------------*/
        $path  = trim(explode('?', $uri)[0], '/');
        $parts = explode('/', $path);

        /** -------------------------------------------------------------
         * 2. RISOLUZIONE CONTROLLER
         * --------------------------------------------------------------*/
        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'Home';
        $controllerClass = 'Controller\\' . $controllerName . 'Controller';
        
        /** -------------------------------------------------------------
         * 3. RISOLUZIONE METODO E PARAMETRI
         * --------------------------------------------------------------*/
        if (isset($parts[1]) && is_numeric($parts[1])) {
            // Esempio: /materiale/5 → metodo = mostra(5)
            $metodo = 'mostra';               
            $params = array_slice($parts, 1); 
        } else {
            // Esempio: /materiale/preferito/3 → metodo = preferito(3)
            $metodo = $parts[1] ?? 'index';   
            $params = array_slice($parts, 2); 
        }

        /** -------------------------------------------------------------
         * 4. VERIFICA CONTROLLER
         * --------------------------------------------------------------*/
        if (!class_exists($controllerClass)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $controller = new $controllerClass();

        /** -------------------------------------------------------------
         * 5. VERIFICA METODO
         * --------------------------------------------------------------*/
        if (!method_exists($controller, $metodo)) {
            header('HTTP/1.1 405 Method Not Allowed');
            exit;
        }

        /** -------------------------------------------------------------
         * 6. ESECUZIONE METODO
         * --------------------------------------------------------------*/
        call_user_func_array([$controller, $metodo], $params);
    }
}
