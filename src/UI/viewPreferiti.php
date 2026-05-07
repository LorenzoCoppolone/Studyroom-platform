<?php

namespace UI;

class ViewPreferiti {

// Funzione che restituisce l'ID del materiale su cui l'utente ha cliccato
    public function getIdMateriale() : ?int{
        return $_POST['idMateriale'] ??null ;
    }

// Funzione che mostra il pop-up che il materiale e stato aggiunto ai preferiti (?-l`interfaccia va implementata qui-?)
    public function mostraPopUpAggiunto() : void {

    }

// Funzione che mostra il pop-up che il materiale e stato rimosso dai preferiti (?-l`interfaccia va implementata qui-?)
    public function mostraPopUpRimosso() : void {
        
    }
}
   