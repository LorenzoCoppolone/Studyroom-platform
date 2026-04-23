<?php

class Appunto extends Materiale {
    private string $tag_appunti;



    /**
     * Costruttore di appunti.
     * 
     * @param int $id_materiale ID del materiale.
     * @param string $Titolo_materiale Titolo del materiale.
     * @param int $id_insegnamento L'ID dell'insegnamento associato al materiale.
     * @param int $id_utente L'ID dell'utente che ha caricato il materiale.
     * @param int $id_file L'ID del file associato al materiale.
     * @param string $tag_appunti Tag degli appunti.
     */
    public function __construct(int $id_materiale, string $Titolo_materiale, int $id_insegnamento, int $id_utente, int $id_file, string $tag_appunti) {
        parent::__construct($id_materiale, $Titolo_materiale, $id_insegnamento, $id_utente, $id_file);
        $this->tag_appunti = $tag_appunti;
    }




    /**
     * Ottiene il tag degli appunti.
     * 
     * @return string Il tag degli appunti.
     */
    public function getTagAppunti(): string {
        return $this->tag_appunti;
    }





    /**
     * Imposta il tag degli appunti.
     * 
     * @param string $tag_appunti Il tag degli appunti.
     */
    public function setTagAppunti(string $tag_appunti): void {
        $this->tag_appunti = $tag_appunti;
    }

}