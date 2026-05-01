<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
class Download {
    
    #[ORM\Id]

    #[ORM\GeneratedValue]

    #[ORM\Column(type: Types::INTEGER)]
    private int $id;
    
    /** @var Materiale
     * Ogni download è associato a un solo materiale, 
     * ma un materiale può essere scaricato in più download.
     * quindi è una relazione molti a uno tra Download e Materiale,
     * La proprietà "materiale" rappresenta il materiale scaricato.
     */

    #[ORM\ManyToOne(targetEntity: Materiale::class, inversedBy: 'downloads')]
    private Materiale $materiale;

    /** @var Studente
    * Ogni download è associato a un solo studente,
    * ma uno studente può effettuare più download.
    * quindi è una relazione molti a uno tra Download e Studente,
    * La proprietà "studente" rappresenta lo studente che ha effettuato il download.
    */
    
    #[ORM\ManyToOne(targetEntity: Studente::class, inversedBy: 'downloads')]
    private Studente $studente;

    /**
     * Costruttore di download.
     * @param int $id ID del download.
     * @param Materiale $materiale materiale scaricato.
     * @param Studente $studente studente che ha effettuato il download.
     */

    public function __construct(
        int $id, 
        Materiale $materiale, 
        Studente $studente
        ) {
        $this->id = $id;
        $this->materiale = $materiale;
        $this->studente = $studente;
    }

    /**
     * Restituisce l'ID del download.
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta/modifica l'ID del download.
     * 
     * @param int $id Nuovo ID.
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Restituisce il materiale associato al download.
     * 
     * @return Materiale
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta il materiale associato al download.
     * @param Materiale $materiale Nuovo materiale.
     * @return void
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

    /**
     * Restituisce lo studente che ha effettuato il download.
     * @return Studente
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Imposta/modifica lo studente associato al download.
     * @param Studente $studente Nuovo studente.
     * @return void
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }

}