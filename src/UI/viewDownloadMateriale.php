<?php

class viewDownloadMateriale {

// Funzione che restituisce l'ID del materiale su cui l'utente ha cliccato
    public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
    }

// Funzione che serve il file
    public function serviFile($file) : void {
        
    }

// Funzione che mostra il pop-up che il materiale si sta scaricando
    public function mostraPopUpDownload() :void {

    }


}