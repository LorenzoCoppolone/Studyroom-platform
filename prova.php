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

//$controller = new CaricaMaterialeController();
//$file = new File(random_bytes(1024), "application/pdf", 1024);
//$result = $controller->caricaMateriale($file, "esame", "ANALISI MATEMATICA I","", "analisi 1 esame engel",1);

$pm = PersistentManager::getInstance();
$result = $pm->cercaMaterialePerTitolo("analisi 1",0,8);
print_r($result);