<?php

class Esame extends Materiale {

   /**
    * Costruttore di esame.
    * @param int $id_materiale ID del materiale.
    * @param string $Titolo_materiale Titolo del materiale.
    * @param int $id_esame ID dell'esame.
    * @param string $Titolo_esame Titolo dell'esame.
    */
    public function __construct(int $id_materiale, string $Titolo_materiale) {
        parent::__construct($id_materiale, $Titolo_materiale);
    }
}