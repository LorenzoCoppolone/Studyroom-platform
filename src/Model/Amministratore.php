<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Amministratore extends Utente{

    /** @var Collection<int, Segnalazione> 
    * un amministratore può gestire più segnalazioni, 
    * quindi è una relazione OneToMany tra Amministratore e Segnalazione, 
    * ma ogni segnalazione è gestita da un solo amministratore.
    */
    #[ORM\OneToMany(targetEntity: Segnalazione::class, mappedBy: "amministratore")]
    private Collection $segnalazioni;





     /**
     * Costruttore di amministratore.
     * 
     * @param int $id ID dell'amministratore.
     * @param string $nome Nome dell'amministratore.
     * @param string $cognome Cognome dell'amministratore.
     * @param string $email Email dell'amministratore.
     * @param string $passwordHash Password dell'amministratore.
     * @param Collection $segnalazioniRicevute Segnalazioni ricevute dall'amministratore.
     */ 

    /**
     * Costruttore di amministratore.
     * 
     * @param int $id ID dell'amministratore.
     * @param string $nome Nome dell'amministratore.
     * @param string $cognome Cognome dell'amministratore.
     * @param string $email Email dell'amministratore.
     * @param string $passwordHash Password dell'amministratore.
     * @param Collection $segnalazioni Segnalazioni ricevute dall'amministratore.
     */
    public function __construct(
        int $id, 
        string $nome, 
        string $cognome, 
        string $email, 
        string $passwordHash,
        Collection $segnalazioni = new ArrayCollection()
        ) {
        parent::__construct($id, $nome, $cognome, $email, $passwordHash);
        $this->segnalazioni = $segnalazioni;
    }

        /**
        * Ottiene le segnalazioni ricevute dall'amministratore.
        * 
        * @return Collection Le segnalazioni ricevute dall'amministratore.
        */
    public function getSegnalazioni(): Collection {
        return $this->segnalazioni;
    }



    /**
     * Imposta le segnalazioni ricevute dall'amministratore.
     * 
     * @param Collection $segnalazioni Le segnalazioni ricevute dall'amministratore.
     */
    public function setSegnalazioni(Collection $segnalazioni): void {
        $this->segnalazioni = $segnalazioni;
    }

}