<?php
require_once 'Tag.php';

class Appunto extends Materiale {
    private Tag $tag;
}


    /**
     * Costruttore di appunti.
     * 
     * @param int $id ID del materiale.
     * @param string $titolo Titolo del materiale.
     * @param Insegnamento $insegnamento insegnamento associato al materiale.
     * @param Studente $studente studente che ha caricato il materiale.
     * @param File $file file associato al materiale.
     * @param  Tag $tag Tag degli appunti.
     */
    public function __construct(
        int $id, 
        string $titolo, 
        Insegnamento $insegnamento, 
        Studente $studente, 
        File $file, 
        Tag $tag
        ) {
        parent::__construct(
            $id, 
            $titolo, 
            $insegnamento, 
            $studente, 
            $file);
        $this->tag = $tag;
    }


    /**
     * Ottiene il tag degli appunti.
     * 
     * @return Tag Il tag degli appunti.
     */
    public function getTag(): Tag {
        return $this->tag;
    }

    /**
     * Imposta il tag degli appunti.
     * 
     * @param Tag $tag_appunti Il tag degli appunti.
     */
    public function setTag(Tag $tag): void {
        $this->tag = $tag;
    }

}