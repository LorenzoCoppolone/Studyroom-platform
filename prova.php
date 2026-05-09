<?php
require_once __DIR__ . '/vendor/autoload.php';
use Foundation\Persistent\PersistentManager;
use Controller\RicercaMaterialeController;
use Controller\CaricaMaterialeController;
use Model\Appunto;
use Model\Esame;
use Model\File;
use Model\Studente;
use Model\Tag;

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
/*
$studente = new Studente(0, "vincenzo", "zaratustra", "vincenzo.zaratustra@student.univaq.it", "recanati", "zava");
$pm->save($studente);
$controller = new CaricaMaterialeController();
$file = new File(random_bytes(1024), "application/pdf", 1024);
$insegnamento = $pm->findOneBy("Model\Insegnamento", ["nomeInsegnamento" => "ANALISI ED ELABORAZIONE DEI SEGNALI"]);
$mat1 = new appunto("analisi dei segnali note piero",$file, $insegnamento, $studente,Tag::NOTE);
$mat2 = new Esame("esercizi analisi dei segnali franco",$file, $insegnamento, $studente);
$pm->save($mat1);
$pm->save($mat2);
*/

$result = $pm->CercaMateriale("a","","","","","",0,2);
print_r($result);