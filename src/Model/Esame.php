<?php
namespace Model;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
class Esame extends Materiale {

   /**
    * Costruttore di esame.
    * @param string $titolo Titolo del materiale.
    * @param Insegnamento $insegnamento insegnamento associato al materiale.
    * @param Studente $studente studente che ha caricato il materiale.
    * @param File $file file associato al materiale.
    */
    public function __construct(
        string $titolo,
        File $file,
        Insegnamento $insegnamento,
        Studente $studente
        ) {
        parent::__construct(
            $titolo,
            $file, 
            $insegnamento, 
            $studente
            );
    }
}