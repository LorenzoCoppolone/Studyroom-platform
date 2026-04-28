<?php

class Segnalazione {
    private int $id;
    private string $motivo;
    private DateTime $timeStamp;
    
    private Studente $segnalante;
    private Studente $segnalato;
    private Materiale $materiale;
    private Amministratore $amministratore;

    /**
     * Costruttore di segnalazione.
     * @param int $id_segnalazione ID della segnalazione.
     * @param string $motivo_segnalazione Motivo della segnalazione.
     * @param Studente $segnalante studente che ha segnalato.
     * @param Studente $segnalato studente segnalato.
     * @param Materiale $materiale materiale segnalato.
     * @param Amministratore $amministratore amministratore che gestisce la segnalazione.
     */
    public function __construct(
        int $id, 
        string $motivo,  
        Studente $segnalante,
        Studente $segnalato,
        Materiale $materiale,
        Amministratore $amministratore
        ) {
        $this->id = $id;
        $this->motivo = $motivo;
        $this->timeStamp = new DateTime();
        $this->segnalante = $segnalante;
        $this->segnalato = $segnalato;
        $this->materiale = $materiale;
        $this->amministratore = $amministratore;
    }

    /**
     * Restituisce l'ID della segnalazione.
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta/modifica l'ID della segnalazione.
     * 
     * @param int $id Nuovo ID.
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Restituisce il motivo della segnalazione.
     * 
     * @return string
     */
    public function getMotivo(): string {
        return $this->motivo;
    }

    /**
     * Imposta/modifica il motivo della segnalazione.
     * 
     * @param string $motivo Nuovo motivo.
     * @return void
     */
    public function setMotivo(string $motivo): void {
        $this->motivo = $motivo;
    }

    /**
     * Restituisce la data/ora della segnalazione.
     * 
     * @return DateTime
     */
    public function getTimeStamp(): DateTime {
        return $this->timeStamp;
    }

    /**
     * Imposta/modifica il timestamp della segnalazione.
     * 
     * @param DateTime $timeStamp Nuova data/ora.
     * @return void
     */
    public function setTimeStamp(DateTime $timeStamp): void {
        $this->timeStamp = $timeStamp;
    }

    /**
     * Restituisce lo studente che ha effettuato la segnalazione.
     * 
     * @return Studente
     */
    public function getSegnalante(): Studente {
        return $this->segnalante;
    }

    /**
     * Imposta/modifica lo studente segnalante.
     * 
     * @param Studente $segnalante Nuovo segnalante.
     * @return void
     */
    public function setSegnalante(Studente $segnalante): void {
        $this->segnalante = $segnalante;
    }

    /**
     * Restituisce lo studente segnalato.
     * 
     * @return Studente
     */
    public function getSegnalato(): Studente {
        return $this->segnalato;
    }

    /**
     * Imposta/modifica lo studente segnalato.
     * 
     * @param Studente $segnalato Nuovo segnalato.
     * @return void
     */
    public function setSegnalato(Studente $segnalato): void {
        $this->segnalato = $segnalato;
    }

    /**
     * Restituisce il materiale segnalato.
     * 
     * @return Materiale
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta/modifica il materiale segnalato.
     * 
     * @param Materiale $materiale Nuovo materiale.
     * @return void
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

    /**
     * Restituisce l'amministratore che gestisce la segnalazione.
     * 
     * @return Amministratore
     */
    public function getAmministratore(): Amministratore {
        return $this->amministratore;
    }

    /**
     * Imposta/modifica l'amministratore.
     * 
     * @param Amministratore $amministratore Nuovo amministratore.
     * @return void
     */
    public function setAmministratore(Amministratore $amministratore): void {
        $this->amministratore = $amministratore;
    }

}