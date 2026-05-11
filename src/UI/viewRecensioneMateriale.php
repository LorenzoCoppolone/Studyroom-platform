<?php

namespace UI;

class viewRecensioneMateriale {

// Funzione che restituisce l'ID del materiale su cui l'utente ha cliccato per effettuare la recensione
public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
}

// Funzione che restituisce il voto della recensione che l'utente ha inserito
public function getVoto() : ?float {
        return $_POST['voto'] ?? null;
}

// Funzione che restituisce ila descrizione inserita dall`utente nella recensione
public function getCommento() : ?string {
        return $_POST['commento'] ?? null;
}

public function mostraFormRecensione() : void {
        //logica per mostrare il form di recensione
}

//Funzione che mostra il pop-up che conferma che la recensione e stata effettuata
public function mostraPopUpConfermaRecensione() : void {
  //logica per mostrare il pop-up
}

}