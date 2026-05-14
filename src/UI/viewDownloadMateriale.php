<?php
namespace UI;
class viewDownloadMateriale {


    /**
     * Restituisce l'ID del materiale su cui l'utente ha cliccato
     * 
     * @return ?int
     */
    public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
    }

    /**
     * Restituisce il file su cui l'utente ha cliccato
     * 
     * @return void
     */
    public function serviFile($file) : void {
        
    }

    /**
     * Mostra il popup per il download del materiale
     * 
     * @return void
     */
    public function mostraPopUpDownload() :void {

    }


}