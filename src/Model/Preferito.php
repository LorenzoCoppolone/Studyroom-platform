<?php
namespace Model;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
#[ORM\Entity]
class Preferito {

    // Attributi

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)] 
    private int $id;

    /** @var Studente
     * Relazione molti a uno tra Preferito e Studente.
     * Ogni preferito è associato a un solo studente, ma uno studente può avere più preferiti.
     * quindi è una relazione molti a uno tra Preferito e Studente,
     * La proprietà "studente" rappresenta lo studente che ha aggiunto il materiale ai preferiti.
     * La colonna "studente_id" nella tabella "preferito" fa riferimento alla colonna "id" della tabella "studente".
     */
    #[ORM\ManyToOne(targetEntity: Studente::class, inversedBy: 'preferiti')]
    private Studente $studente;

    /** @var Materiale
     * Relazione molti a uno tra Preferito e Materiale.
     * Ogni preferito è associato a un solo materiale, 
     * ma un materiale può essere aggiunto a più preferiti.
     * quindi è una relazione molti a uno tra Preferito e Materiale,
     * La proprietà "materiale" rappresenta il materiale aggiunto ai preferiti.
     * La colonna "materiale_id" nella tabella "preferito" fa riferimento alla colonna "id" della tabella "materiale".
     */
    #[ORM\ManyToOne(targetEntity: Materiale::class, inversedBy: 'preferiti')]
    private Materiale $materiale;






    
    /**
     * Costruttore di preferito.
     * @param int $id ID del preferito.
     * @param Studente $studente studente che ha aggiunto il materiale ai preferiti.
     * @param Materiale $materiale materiale aggiunto ai preferiti.
     */
    public function __construct(
        int $id, 
        Studente $studente, 
        Materiale $materiale
        ) {
        $this->id = $id;
        $this->studente = $studente;
        $this->materiale = $materiale;
    }

    /**
     * Ottiene l'ID del preferito.
     * @return int L'ID del preferito.
     */
    public function getIdPreferito(): int {
        return $this->id;
    }

    /**
     * Ottiene lo studente che ha aggiunto il materiale ai preferiti.
     * @return Studente studente che ha aggiunto il materiale ai preferiti.
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Ottiene il materiale aggiunto ai preferiti.
     * @return Materiale materiale aggiunto ai preferiti.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta l'ID del preferito.
     * @param int $id L'ID del preferito.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Imposta lo studente che ha aggiunto il materiale ai preferiti.
     * @param Studente $studente lo studente che ha aggiunto il materiale ai preferiti.
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }

    /**
     * Imposta il materiale aggiunto ai preferiti.
     * @param Materiale $materiale materiale aggiunto ai preferiti.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }
}