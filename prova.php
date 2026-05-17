<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\AnteprimaPdfServices;
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
use Model\Segnalazione;
use Model\Amministratore;


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

// Creo un nuova recensione 
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


// ─────────────────────────────────────────────────────────────────
// TESTING ANTEPRIMA PDF - Prova della funzione AnteprimaPdfServices
// ─────────────────────────────────────────────────────────────────

$timeStart = microtime(true);

try {
    // Recupera un materiale dal database
    $materiale = $pm->findOneBy(Materiale::class, ['id' => 2]);

    if (!$materiale || !$materiale->getFile()) {
        echo "<h2>⚠️ Nessun materiale trovato</h2>";
        exit;
    }

    // Ottiene il contenuto del file PDF
    $pdfContent = $materiale->getFile()->getContenutoFile();
    $mimeType = $materiale->getFile()->getmimeTypeFile();

    // Genera l'anteprima
    $service = new AnteprimaPdfServices();
    $result = $service->generaAnteprima($pdfContent, $mimeType);

    $timeEnd = microtime(true);
    $duration = round(($timeEnd - $timeStart) * 1000, 2);

    // Output HTML
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anteprima Materiale</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background: #f5f5f5;
            }

            .container {
                max-width: 1000px;
                margin: 0 auto;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #333;
                border-bottom: 2px solid #007bff;
                padding-bottom: 10px;
            }

            .info {
                background: #e8f4f8;
                padding: 15px;
                border-radius: 5px;
                margin: 20px 0;
            }

            .info p {
                margin: 5px 0;
            }

            .label {
                font-weight: bold;
                color: #007bff;
            }

            .preview {
                margin-top: 30px;
                text-align: center;
            }

            .preview img {
                max-width: 100%;
                height: auto;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            .performance {
                background: #fffbea;
                padding: 10px;
                border-left: 4px solid #ffc107;
                margin-top: 15px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>📄 Anteprima Materiale</h1>
            <div class="info">
                <p><span class="label">Materiale:</span> <?= $materiale->getTitolo() ?></p>
                <p><span class="label">Tipo:</span> <?= $mimeType ?></p>
                <p><span class="label">Dimensione PDF:</span> <?= number_format(strlen($pdfContent) / 1024, 2) ?> KB</p>
                <p><span class="label">Dimensione Anteprima (base64):</span> <?= number_format(strlen($result['contenuto']) / 1024, 2) ?> KB</p>
                <div class="performance">
                    <p><span class="label">⏱️ Tempo elaborazione:</span> <strong><?= $duration ?> ms</strong></p>
                </div>
            </div>
            <div class="preview">
                <img src="data:<?= $result['mimeType'] ?>;base64,<?= $result['contenuto'] ?>" alt="Anteprima PDF">
            </div>
        </div>
    </body>

    </html>
<?php

} catch (Throwable $e) {
?>
    <h2>❌ Errore durante la generazione dell'anteprima</h2>
    <p><?= $e->getMessage() ?></p>
    <p><small><?= $e->getFile() ?>:<?= $e->getLine() ?></small></p>
<?php
}



/*
// TESTING MATERIALE UTENTE materialiPopolariUtente

// Cerco materiali popolari dell'utente Sara
print_r($pm->materialiPopolariUtente(17, 0, 4));
*/


/*
// CREAZIONE ADMIN
$nome = "Vinicio";
$cognome = "Maurizio";
$email = "vinicio.maurizio@admin.univaq.it";
$passwordHash = "Pippo";

$admin = new Amministratore($nome, $cognome, $email, $passwordHash);

$pm->save($admin);
*/


/*
// TESTING CERCA SEGNALAZIONE - LATO ADMIN trovaMaterialiSegnalati

// Creazione nuova segnalazione
// Sara segnala un materiale 
$studenteSegnalante1 = $pm->findOneBy(Studente :: class, [
    'id' => 17 
]);

$materialeSegnalato1 = $pm->findOneBy(Materiale :: class , [
    'id' => 3
]);

// Recupero l'admin
$admin = $pm->findOneBy(Amministratore :: class , [
    'id' => 1
]);

$motivo = "Contenuto osceno.";

$nuovaSegnalazione = new Segnalazione($motivo, $studenteSegnalante1, $materialeSegnalato1, $admin);

$pm->save($nuovaSegnalazione);


// Cerco i materiali segnalati
print_r($pm->trovaMaterialiSegnalati(0, 4));
*/


/*
$path = "C:\\Users\\msi 167034\\OneDrive\\Desktop\\Tesina3.pdf";

$contenuto = file_get_contents($path);
$dimensione = filesize($path);
$mime = mime_content_type($path);



$studente = $pm->findOneBy(
    "Model\\Studente",
    ["id" => 1]
);

$insegnamento = $pm->findOneBy(
    "Model\\Insegnamento",
    ["nomeInsegnamento" => "ANALISI ED ELABORAZIONE DEI SEGNALI",
     "corsoDiLaurea"=> "I3N"]
);

$file = new File($contenuto, $mime, $dimensione);

$materiale = new Appunto(
    "Pippo",
    $file,
    $insegnamento,
    $studente,
    Tag::NOTE
);

$pm->save($materiale);

*/