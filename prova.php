<?php
require_once __DIR__ . '/vendor/autoload.php';
use Foundation\Persistent\PersistentManager;
use Controller\RicercaMaterialeController;
use Controller\CaricaMaterialeController;
use Model\Appunto;
use Model\Esame;
use Model\File;
use Model\Studente;
use Model\Materiale;
use Model\Tag;
use Model\Preferito;
use Model\Download;
use Model\Recensione;

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
$studente = new Studente( "Vincenzo", "zaratustra", "vincenzo.zaratustra@student.univaq.it", "recanati", "zava");
$pm->save($studente);
$controller = new CaricaMaterialeController();
$file = new File(random_bytes(1024), "application/pdf", 1024);
$insegnamento = $pm->findOneBy("Model\Insegnamento", ["nomeInsegnamento" => "ANALISI ED ELABORAZIONE DEI SEGNALI"]);
$mat1 = new appunto("analisi dei segnali note piero",$file, $insegnamento, $studente,Tag::NOTE);
$mat2 = new Esame("esercizi analisi dei segnali franco",$file, $insegnamento, $studente);
$pm->save($mat1);
$pm->save($mat2);*/
/*
//UTENTE 1
$studente1 = new Studente(
    "Marco",
    "Rossi",
    "marco.rossi@student.univaq.it",
    "L'Aquila",
    "pass123"
);
$pm->save($studente1);

$file1 = new File(random_bytes(1024), "application/pdf", 1024);

$insegnamento = $pm->findOneBy(
    "Model\\Insegnamento",
    ["nomeInsegnamento" => "ANALISI ED ELABORAZIONE DEI SEGNALI"]
);

$mat1 = new Appunto(
    "Appunti segnali - Marco",
    $file1,
    $insegnamento,
    $studente1,
    Tag::NOTE
);

$mat2 = new Esame(
    "Esame segnali - Marco",
    $file1,
    $insegnamento,
    $studente1
);

$pm->save($mat1);
$pm->save($mat2);

// UTENTE 2
$studente2 = new Studente(
    "Giulia",
    "Bianchi",
    "giulia.bianchi@student.univaq.it",
    "Roma",
    "pass123"
);
$pm->save($studente2);

$file2 = new File(random_bytes(1024), "application/pdf", 1024);

$mat1 = new Appunto(
    "Teoria segnali - Giulia",
    $file2,
    $insegnamento,
    $studente2,
    Tag::RIASSUNTO
);

$mat2 = new Esame(
    "Esercizi segnali - Giulia",
    $file2,
    $insegnamento,
    $studente2
);

$pm->save($mat1);
$pm->save($mat2);

// UTENTE 3
$studente3 = new Studente(
    "Luca",
    "Verdi",
    "luca.verdi@student.univaq.it",
    "Pescara",
    "pass123"
);
$pm->save($studente3);

$file3 = new File(random_bytes(1024), "application/pdf", 1024);

$mat1 = new Appunto(
    "Riassunto segnali - Luca",
    $file3,
    $insegnamento,
    $studente3,
    Tag::RIASSUNTO
);

$mat2 = new Esame(
    "Prova d'esame segnali - Luca",
    $file3,
    $insegnamento,
    $studente3
);

$pm->save($mat1);
$pm->save($mat2);

// UTENTE 4
$studente4 = new Studente(
    "Sara",
    "Neri",
    "sara.neri@student.univaq.it",
    "Teramo",
    "pass123"
);
$pm->save($studente4);

$file4 = new File(random_bytes(1024), "application/pdf", 1024);

$mat1 = new Appunto(
    "Formulario segnali - Sara",
    $file4,
    $insegnamento,
    $studente4,
    Tag::NOTE
);

$mat2 = new Esame(
    "Simulazione esame - Sara",
    $file4,
    $insegnamento,
    $studente4
);

$pm->save($mat1);
$pm->save($mat2);*/

// $result = $pm->CercaMateriale("a",0,1);
// print_r($result);

/*
$studentePr1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);


$materialePr1 = $pm->findOneBy(Materiale :: class , [
    'id' => 26
]);

// echo $studentePr1->getNome();
$nuovoPreferito = new Preferito($studentePr1, $materialePr1);

$pm->save($nuovoPreferito); */

// Cerco un preferito per utente
// print_r($pm->trovaPreferitiPerUtente(17, 0, 2));



/*
// TESTING DOWNLOAD trovaDownloadPerUtente

// Recupero uno studente
$studenteDw1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);

// Recupero il materiale associato
$materialeDw1 = $pm->findOneBy(Materiale :: class , [
    'id' => 26
]);

// Creo un nuovo download in DB
$nuovoDownload = new Download($studenteDw1, $materialeDw1);

$pm->save($nuovoDownload);

// Cerco un Download per utente
print_r($pm->trovaDownloadPerUtente(17, 0, 2));
*/



/*
// TESTING RECENSIONE trovaRecensioniPerUtente
// Recupero uno studente
$studenteRc1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);

// Recupero il materiale associato
$materialeRc1 = $pm->findOneBy(Materiale :: class , [
    'id' => 26
]);

// Voto
$voto = 4.8;

// Commento
$commento = "Bellissimo";
// Creo un nuova recensione in DB
$nuovaRecensione = new Recensione($voto, $commento, $studenteRc1, $materialeRc1);

$pm->save($nuovaRecensione); 

// Cerco recensioni per utente
print_r($pm->trovaRecensioniPerUtente(17, 0, 2)); 
*/




// TESTING MATERIALE UTENTE materialiPopolariUtente

// Cerco materiali popolari dell'utente Sara
// print_r($pm->materialiPopolariUtente(17, 0, 2));

/*
// Inserisco tra i preferiti di Sara altri materiali di altri utenti
$studentePr1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);


$materialePr1 = $pm->findOneBy(Materiale :: class , [
    'id' => 3
]);

// echo $studentePr1->getNome();
$nuovoPreferito = new Preferito($studentePr1, $materialePr1);

$pm->save($nuovoPreferito);
*/

/*
// Creo una recensione
// Recupero uno studente
$studenteRc1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);

// Recupero il materiale associato
$materialeRc1 = $pm->findOneBy(Materiale :: class , [
    'id' => 3
]);

// Voto
$voto = 4.8;

// Commento
$commento = "Bellissimoooo";
// Creo un nuova recensione in DB
$nuovaRecensione = new Recensione($voto, $commento, $studenteRc1, $materialeRc1);

$pm->save($nuovaRecensione); 
*/

/*
// TESTING MATERIALE UTENTE materialiPopolariUtente

// Cerco materiali popolari dell'utente Sara
print_r($pm->materialiPopolariUtente(17, 0, 4));
*/




// TESTING