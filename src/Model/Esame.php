<?php

class Esame extends Materiale {

   /**
    * Costruttore di esame.
    * @param int $id ID del materiale.
    * @param string $titolo Titolo del materiale.
    * @param Insegnamento $insegnamento insegnamento associato al materiale.
    * @param Studente $studente studente che ha caricato il materiale.
    * @param File $file file associato al materiale.
    */
    public function __construct(
        int $id, 
        string $titolo
        Insegnamento $insegnamento, 
        Studente $studente, 
        File $file, 
        ) {
        parent::__construct(
            $id, 
            $titolo
            $insegnamento, 
            $studente, 
            $file);
    }
}