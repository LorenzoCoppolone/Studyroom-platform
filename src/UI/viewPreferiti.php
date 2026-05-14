<?php

namespace UI;

class ViewPreferiti {

    /**
     * Restituisce l'ID del materiale su cui l'utente ha cliccato
     * 
     * @return ?int
     */
    public function getIdMateriale() : ?int{
        return $_POST['idMateriale'] ??null ;
    }

    /**
     * Mostra il pop-up che il materiale e stato aggiunto ai preferiti
     * @return void
     */
    public function mostraPopUpAggiunto() : void {

    }

    /**
     * Mostra il pop-up che il materiale e stato rimosso dai preferiti
     * @return void
     */
    public function mostraPopUpRimosso() : void {
        
    }
}
   