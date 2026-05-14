<?php

namespace UI;

class viewRecensioneMateriale {

/**
 * Restituisce l'ID del materiale su cui l'utente ha cliccato
 * 
 * @return ?int
 */
public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
}

/**
 * Restituisce il voto inserito dall'utente nella recensione
 * 
 * @return ?float
 */
public function getVoto() : ?float {
        return $_POST['voto'] ?? null;
}

/**
 * Restituisce il commento inserito dall'utente nella recensione
 * 
 * @return ?string
 */
public function getCommento() : ?string {
        return $_POST['commento'] ?? null;
}

/**
 * Mostra il form di recensione
 * 
 * @return void
 */
public function mostraFormRecensione() : void {
        //logica per mostrare il form di recensione
}

/**
 * Mostra il pop-up di conferma della recensione
 * 
 * @return void
 */
public function mostraPopUpConfermaRecensione() : void {
  //logica per mostrare il pop-up
}

}