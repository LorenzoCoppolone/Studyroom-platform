<?php
class Studente extends Utente {
    // Private properties
    private string $username;
    private bool $stato_studente;

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
        bool $stato_studente
        ) {
        parent::__construct($id, $nome, $cognome, $email, $passwordHash);
        $this->username = $username;
        $this->stato_studente = $stato_studente;
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
    public function setStatoStudente(bool $stato_studente): void {
        $this->stato_studente = $stato_studente;
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
    public function getStatoStudente(): bool {
        return $this->stato_studente;
    }
}