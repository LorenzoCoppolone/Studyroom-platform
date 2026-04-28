<?php
class Studente extends Utente {
    // Private properties
    private string $username;
    private bool $stato;

    /** @var Segnalazione[] */
    private array $segnalazioniFatte = [];

    /** @var Segnalazione[] */
    private array $segnalazioniRicevute = [];

    /**
     * Costruttore di studente.
     * 
     * @param int $id ID dello studente.
     * @param string $nome Nome dello studente.
     * @param string $cognome Cognome dello studente.
     * @param string $email Email dello studente.
     * @param string $passwordHash Password dello studente.
     * @param string $username Username dello studente.
     * @param bool $stato_studente Stato dello studente (attivo o non attivo).
     */
    public function __construct(
        int $id,
        string $nome, 
        string $cognome, 
        string $email, 
        string $passwordHash, 
        string $username, 
        bool $stato
        ) {
        parent::__construct(
            $id, 
            $nome, 
            $cognome, 
            $email, 
            $passwordHash
            );
        $this->username = $username;
        $this->stato = $stato;
    }

    /**
     * Inserisce lo username dello studente.
     * 
     * @param string $username Username dello studente.
     */ 
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * Inserisce lo stato dello studente.
     * 
     * @param bool $stato_studente Stato dello studente (attivo o non attivo).
     */
    public function setStato(bool $stato): void {
        $this->stato = $stato;
    }

    /**
     * Ottiene lo username dello studente.
     * 
     * @return string Username dello studente.
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Ottiene lo stato dello studente.
     * 
     * @return bool Stato dello studente (attivo o non attivo).
     */
    public function getStato(): bool {
        return $this->stato;
    }

    /**
     * Restituisce le segnalazioni effettuate dallo studente.
     * 
     * @return Segnalazione[]
     */
    public function getSegnalazioniFatte(): array {
        return $this->segnalazioniFatte;
    }

    /**
     * Aggiunge una segnalazione fatta dallo studente.
     * 
     * @param Segnalazione $segnalazione Segnalazione da aggiungere.
     * @return void
     */
    public function aggiungiSegnalazioneFatta(Segnalazione $segnalazione): void {
        $this->segnalazioniFatte[] = $segnalazione;
    }

    /**
     * Restituisce le segnalazioni ricevute dallo studente.
     * 
     * @return Segnalazione[]
     */
    public function getSegnalazioniRicevute(): array {
        return $this->segnalazioniRicevute;
    }

    /**
     * Aggiunge una segnalazione ricevuta dallo studente.
     * 
     * @param Segnalazione $segnalazione Segnalazione da aggiungere.
     * @return void
     */
    public function aggiungiSegnalazioneRicevuta(Segnalazione $segnalazione): void {
        $this->segnalazioniRicevute[] = $segnalazione;
    }
    
}