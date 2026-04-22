<?php

class Segnalazione {
    private int $id_segnalazione;
    private string $motivo_segnalazione;
    private datetime $data_segnalazione;
    private Studente $Utente_segnalatore;
    private Studente $Utente_segnalato;
    private Amministratore $amministratore;
    private Materiale $materiale;


    /**
     * Costruttore di segnalazione.
     * @param int $id_segnalazione ID della segnalazione.
     * @param Studente $Utente_segnalatore Utente che ha segnalato.
     * @param Studente $Utente_segnalato Utente segnalato.
     * @param Amministratore $amministratore Amministratore che ha segnalato.
     * @param Materiale $materiale Materiale segnalato.
     * @param datetime $data_segnalazione Data della segnalazione.
     * @param string $motivo_segnalazione Motivo della segnalazione.
     */
    public function __construct(int $id_segnalazione, string $motivo_segnalazione, datetime $data_segnalazione, Studente $Utente_segnalatore, Studente $Utente_segnalato, Amministratore $amministratore, Materiale $materiale) {
        $this->id_segnalazione = $id_segnalazione;
        $this->motivo_segnalazione = $motivo_segnalazione;
        $this->data_segnalazione = $data_segnalazione;
        $this->Utente_segnalatore = $Utente_segnalatore;
        $this->Utente_segnalato = $Utente_segnalato;
        $this->amministratore = $amministratore;
        $this->materiale = $materiale;
    }


    /**
     * Ottiene l'ID della segnalazione.
     * @return int L'ID della segnalazione.
     */
    public function getIdSegnalazione(): int {
        return $this->id_segnalazione;
    }

    /**
     * Imposta l'ID della segnalazione.
     * @param int $id_segnalazione L'ID della segnalazione.
     */
    public function setIdSegnalazione(int $id_segnalazione): void {
        $this->id_segnalazione = $id_segnalazione;
    }

    /**
     * Ottiene la descrizione della segnalazione.
     * @return string La descrizione della segnalazione.
     */
    public function getDescrizione(): string {
        return $this->descrizione;
    }

    /**
     * Imposta la descrizione della segnalazione.
     * @param string $descrizione La descrizione della segnalazione.
     */
    public function setDescrizione(string $descrizione): void {
        $this->descrizione = $descrizione;
    }
    
    /**
     * Ottiene l'utente associato alla segnalazione.
     * @return Utente L'utente associato alla segnalazione.
     */
    public function getUtente(): Utente {
        return $this->utente;
    }

    /**
     * Imposta l'utente associato alla segnalazione.
     * @param Utente $utente L'utente associato alla segnalazione.
     */
    public function setUtente(Utente $utente): void {
        $this->utente = $utente;
    }

    
    /**
     * Ottiene il materiale associato alla segnalazione.
      * @return Materiale Il materiale associato alla segnalazione.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta il materiale associato alla segnalazione.
      * @param Materiale $materiale Il materiale associato alla segnalazione.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

    /**
     * Ottiene l'amministratore associato alla segnalazione.
      * @return Amministratore L'amministratore associato alla segnalazione.
     */
    public function getAmministratore(): Amministratore {
        return $this->amministratore;
    }


    /**
     * Imposta l'amministratore associato alla segnalazione.
      * @param Amministratore $amministratore L'amministratore associato alla segnalazione.
     */
    public function setAmministratore(Amministratore $amministratore): void {
        $this->amministratore = $amministratore;
    }

    /**
     * Ottiene l'utente segnalatore.
     * @return Studente L'utente segnalatore.
     */
    public function getUtenteSegnalatore(): Studente {
        return $this->Utente_segnalatore;
    }

    /**
     * Imposta l'utente segnalatore.
     * @param Studente $Utente_segnalatore L'utente segnalatore.
     */
    public function setUtenteSegnalatore(Studente $Utente_segnalatore): void {
        $this->Utente_segnalatore = $Utente_segnalatore;
    }

    /**
     * Ottiene l'utente segnalato.
     * @return Studente L'utente segnalato.
     */
    public function getUtenteSegnalato(): Studente {
        return $this->Utente_segnalato;
    }

    /**
     * Imposta l'utente segnalato.
     * @param Studente $Utente_segnalato L'utente segnalato.
     */
    public function setUtenteSegnalato(Studente $Utente_segnalato): void {
        $this->Utente_segnalato = $Utente_segnalato;
    }

    /**
     * Ottiene la data della segnalazione.
      * @return datetime La data della segnalazione.
     */
    public function getDataSegnalazione(): datetime {
        return $this->data_segnalazione;
    }

    /**
     * Imposta la data della segnalazione.
      * @param datetime $data_segnalazione La data della segnalazione.
     */
    public function setDataSegnalazione(datetime $data_segnalazione): void {
        $this->data_segnalazione = $data_segnalazione;
    }

    /**
     * Ottiene il motivo della segnalazione.
     * @return string Il motivo della segnalazione.
     */
    public function getMotivoSegnalazione(): string {
        return $this->motivo_segnalazione;
    }

    /**
     * Imposta il motivo della segnalazione.
     * @param string $motivo_segnalazione Il motivo della segnalazione.
     */
    public function setMotivoSegnalazione(string $motivo_segnalazione): void {
        if (strlen($motivo_segnalazione) > 255) {
            throw new Exception("Il motivo della segnalazione non può essere più lungo di 255 caratteri."); 
    }
        $this->motivo_segnalazione = $motivo_segnalazione;
    }

    



}