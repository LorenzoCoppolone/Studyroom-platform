<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
class Recensione {

    #[ORM\Id]

    #[ORM\GeneratedValue]

    #[ORM\Column(type: Types::INTEGER)] 
    private int $id;

    #[ORM\Column(type: "float")]
    private float $voto;

    #[ORM\Column(type: "string", length: 255)]
    private string $commento;

    /**
     * Relazione molti a uno tra Recensione e Materiale.
     * Ogni recensione è associata a un solo materiale, ma un materiale può avere più recensioni.
     * La proprietà "materiale" rappresenta il materiale recensito.
     * La colonna "materiale_id" nella tabella "recensione" fa riferimento alla colonna "id" della tabella "materiale".
     */

    #[ORM\ManyToOne(targetEntity: Materiale::class, inversedBy: "recensioni")]

    #[ORM\JoinColumn(name: "materiale_id", referencedColumnName: "id")]
    private Materiale $materiale;

    /**
    * Relazione molti a uno tra Recensione e Studente.
    * Ogni recensione è scritta da un solo studente, ma uno studente può scrivere più recensioni.
    * La proprietà "studente" rappresenta lo studente che ha scritto la recensione.
    * La colonna "studente_id" nella tabella "recensione" fa riferimento alla colonna "id" della tabella "studente".
    */

    #[ORM\ManyToOne(targetEntity: Studente::class, inversedBy: "recensioni")]
    
    #[ORM\JoinColumn(name: "studente_id", referencedColumnName: "id")]
    private Studente $studente;

    /**
     * Costruttore di recensione.
     * @param int $id ID della recensione.
     * @param float $voto Voto della recensione.
     * @param string $commento Commento della recensione.
     * @param Studente $studente  studente che ha scritto la recensione.
     * @param Materiale $materiale materiale recensito.
     */

    public function __construct(
        int $id, 
        float $voto, 
        string $commento, 
        Studente $studente, 
        Materiale $materiale
        ) {
        $this->id = $id;
        $this->voto = $voto;
        $this->commento = $commento;
        $this->studente = $studente;
        $this->materiale = $materiale;
    }

    /**
     * Ottiene l'ID della recensione.
     * @return int L'ID della recensione.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Ottiene il voto della recensione.
     * @return float Il voto della recensione.
     */
    public function getVoto(): float {
        return $this->voto;
    }

    /**
     * Ottiene il commento della recensione.
     * @return string Il commento della recensione.
     */
    public function getCommento(): string {
        return $this->commento;
    }

    /**
     * Ottiene lo studente che ha scritto la recensione.
     * @return Studente studente che ha scritto la recensione.
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Ottiene il materiale recensito.
     * @return Materiale materiale recensito.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta l'ID della recensione.
     * @param int $id L'ID della recensione.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Imposta il voto della recensione.
     * @param float $voto Il voto della recensione.
     */
    public function setVoto(float $voto): void {
        $this->voto = $voto;
    }

    /**
     * Imposta il commento della recENSIONE.
     * @param string $commento Il commento della recENSIONE.
     */
    public function setCommento(string $commento): void {
        $this->commento = $commento;
    }

    /**
     * Imposta lo studente che ha scritto la recensione.
     * @param Studente $studente  studente che ha scritto la recensione.
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }
     
    /**
     * Imposta il materiale recensito.
     * @param Materiale $materiale materiale recensito.
     * Nota: Passare il materiale per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }
    
}