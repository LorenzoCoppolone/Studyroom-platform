<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewDownloadMateriale {

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
     * Serve il file richiesto dall'utente.
     *
     * @param mixed $file Oggetto o array contenente i dati del file
     * @return void
     */
    public function serviFile($file) : void {
        // Implementazione futura: headers + echo contenuto
    }

    /**
     * Mostra il popup per il download del materiale
     * 
     * @return void
     */
    public function mostraPopUpDownload() :void {
        // Implementazione futura: template popup
    }


}