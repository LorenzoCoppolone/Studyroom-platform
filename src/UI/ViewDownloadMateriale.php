<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class ViewDownloadMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Restituisce l'ID del materiale su cui l'utente ha cliccato.
     *
     * @return int|null ID del materiale oppure null se non presente
     */
    public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
    }

/**
 * View: effettua il download del materiale salvato nel DB (BLOB),
 * senza nome originale.
 * @param string $mimeType
 * @param int    $dimensione
 * @param string $contenuto  Contenuto binario del file (BLOB)
 * @param int    $idMateriale  (opzionale) per generare un nome coerente
 * @return void
 */
    public function effettuaDownload(string $mimeType, int $dimensione, string $contenuto, int $idMateriale): void {
    // Mappa MIME → estensione
    $estensioni = [
        'application/pdf' => 'pdf',
        'image/jpeg'      => 'jpg',
        'image/png'       => 'png',
        'text/plain'      => 'txt',
        'application/zip' => 'zip',
    ];

    // Estensione dedotta
    $ext = $estensioni[$mimeType] ?? 'bin';

    // Nome file generato
    $nomeFile = "materiale_" . $idMateriale . "." . $ext;

    // Headers per forzare il download
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . $nomeFile . '"');
    header('Content-Length: ' . $dimensione);
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: public');

    if (ob_get_length()) {
        ob_end_clean();
    }

    echo $contenuto;
    exit;
    }



    /**
     * Visualizza un messaggio di errore.
     * 
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('feedback/error.tpl');
    }


}