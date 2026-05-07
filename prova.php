<?php
require_once __DIR__ . '/vendor/autoload.php';
use Foundation\Persistent\PersistentManager;
use Controller\RicercaMaterialeController;
use Controller\CaricaMaterialeController;
use Model\File;



//TESTING RICERCA

// try {
//     $controller = new RicercaMaterialeController();
//     $result = $controller->cercaMaterialePerTitolocontroller("titolo di prova");
//     print_r($result);

// } catch (InvalidArgumentException $e) {
//     echo "ERRORE DI VALIDAZIONE: " . $e->getMessage();

// } catch (Exception $e) {
//     echo "ERRORE GENERICO: " . $e->getMessage();
// }


//TESTING CARICAMENTO

try {
    $controller = new CaricaMaterialeController();
} catch (InvalidArgumentException $e) {
    echo "ERRORE DI VALIDAZIONE: " . $e->getMessage();

} catch (Exception $e) {
    echo "ERRORE GENERICO: " . $e->getMessage();
}
