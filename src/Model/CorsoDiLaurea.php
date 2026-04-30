<?php

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
#[ORM\Entity]
class CorsoDiLaurea {

    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, unique: true)]
    private int $codiceCorso;

    #[ORM\Column(type: Types::STRING)]
    private string $nomeCorso;

    /** @var Collection<int, Insegnamento>
    * un corso di laurea può avere più insegnamenti associati,
    * quindi è una relazione OneToMany tra CorsoDiLaurea e Insegnamento,
    * ma ogni insegnamento è associato a un solo corso di laurea.
    */
    #[ORM\OneToMany(mappedBy: 'corsoDiLaurea', targetEntity: Insegnamento::class)]
    private Collection $insegnamenti; //relazione uno a molti con Insegnamento

    
    /**
     * Costruttore di corso di laurea.
     * 
     * @param int $codiceCorso Codice del corso di laurea.
     * @param string $nomeCorso Nome del corso di laurea.
     */
    public function __construct(
        int $codiceCorso, 
        string $nomeCorso,
        Collection $insegnamenti = new ArrayCollection()
        ) {
        $this->codiceCorso = $codiceCorso;
        $this->nomeCorso = $nomeCorso;
        $this->insegnamenti = $insegnamenti;
    }

    /**
     * Restituisce il codice del corso di laurea.
     * 
     * @return int
     */
    public function getCodiceCorso(): int {
        return $this->codiceCorso;
    }

    /**
     * Imposta/modifica il codice del corso di laurea.
     * 
     * @param int $codiceCorso Nuovo codice del corso.
     * @return void
     */
    public function setCodiceCorso(int $codiceCorso): void {
        $this->codiceCorso = $codiceCorso;
    }

    /**
     * Restituisce il nome del corso di laurea.
     * 
     * @return string
     */
    public function getNomeCorso(): string {
        return $this->nomeCorso;
    }

    /**
     * Imposta/modifica il nome del corso di laurea.
     * 
     * @param string $nomeCorso Nuovo nome del corso.
     * @return void
     */
    public function setNomeCorso(string $nomeCorso): void {
        $this->nomeCorso = $nomeCorso;
    }

    /**
     * Restituisce la lista degli insegnamenti.
     * 
     * @return Collection<Insegnamento> La collezione di insegnamenti associati al corso di laurea.
     */
    public function getInsegnamenti(): Collection {
        return $this->insegnamenti;
    }

    /**
     * Aggiunge un insegnamento al corso di laurea.
     * 
     * @param Insegnamento $insegnamento Insegnamento da aggiungere.
     * @return void
     */
    public function aggiungiInsegnamento(Insegnamento $insegnamento): void {
        $this->insegnamenti[] = $insegnamento;
    }

    
}