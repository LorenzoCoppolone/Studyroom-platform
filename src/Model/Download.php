<?php
class Download {
    private int $id;
    private int $numeroDownload;
    
    private Materiale $materiale;
    private Studente $studente;

    /**
     * Costruttore di download.
     * @param int $id_download ID del download.
     * @param int $numeroDownload Numero di download.
     * @param Materiale $materiale materiale scaricato.
     * @param Studente $studente studente che ha effettuato il download.
     */
    public function __construct(
        int $id, 
        int $numeroDownload, 
        Materiale $materiale, 
        Studente $studente
        ) {
        $this->id = $id;
        $this->numeroDownload = $numeroDownload;
        $this->materiale = $materiale;
        $this->studente = $studente;

        $materiale->aggiungiDownload($this);
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
     * Restituisce il numero di download.
     * 
     * @return int
     */
    public function getNumeroDownload(): int {
        return $this->numeroDownload;
    }

    /**
     * Imposta/modifica il numero di download.
     * 
     * @param int $numeroDownload Nuovo numero di download.
     * @return void
     */
    public function setNumeroDownload(int $numeroDownload): void {
        $this->numeroDownload = $numeroDownload;
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
     * Imposta/modifica il materiale associato al download.
     * 
     * @param Materiale $materiale Nuovo materiale.
     * @return void
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

    /**
     * Restituisce lo studente che ha effettuato il download.
     * 
     * @return Studente
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Imposta/modifica lo studente associato al download.
     * 
     * @param Studente $studente Nuovo studente.
     * @return void
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }
}