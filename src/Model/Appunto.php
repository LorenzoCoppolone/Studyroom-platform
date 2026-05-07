<?php
namespace Model;
require_once 'Tag.php';

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
class Appunto extends Materiale {

    #[ORM\Column(type: Types::STRING, enumType: Tag::class)]
     private Tag $tag;

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
        string $titolo, 
        File $file,
        Insegnamento $insegnamento, 
        Studente $studente, 
        Tag $tag,
        ) {
        parent::__construct( 
            $titolo, 
            $file, 
            $insegnamento, 
            $studente,
        );
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
     * @param Tag $tag Il tag degli appunti.
     */
    public function setTag(Tag $tag): void {
        $this->tag = $tag;
    }

}