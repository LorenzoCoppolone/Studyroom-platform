<?php
class Download {
    private int $id_download;
    private int $Numero_download;
    private int $id_materiale;
    private int $id_studente;

    /**
     * Costruttore di download.
     * @param int $id_download ID del download.
     * @param int $Numero_download Numero di download.
     * @param int $id_materiale ID del materiale scaricato.
     * @param int $id_studente ID dello studente che ha effettuato il download.
     */
    public function __construct(int $id_download, int $Numero_download, int $id_materiale, int $id_studente) {
        $this->id_download = $id_download;
        $this->Numero_download = $Numero_download;
        $this->id_materiale = $id_materiale;
        $this->id_studente = $id_studente;
    }

    /**
     * Ottiene l'ID del download.
     * @return int L'ID del download.
     */
    public function getIdDownload(): int {
        return $this->id_download;
    }

    /**
     * Ottiene il numero di download.
     * @return int Il numero di download.
     */
    public function getNumeroDownload(): int {
        return $this->Numero_download;
    }

    /**
     * Ottiene l'ID del materiale scaricato.
     * @return int L'ID del materiale scaricato.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }

    /**
     * Ottiene l'ID dello studente che ha effettuato il download.
     * @return int L'ID dello studente che ha effettuato il download.
     */
    public function getIdStudente(): int {
        return $this->id_studente;
    }

    /**
     * Imposta l'ID del download.
     * @param int $id_download L'ID del download.
     */
    public function setIdDownload(int $id_download): void {
        $this->id_download = $id_download;
    }

    /**
     * Imposta il numero di download.
     * @param int $Numero_download Il numero di download.
     */
    public function setNumeroDownload(int $Numero_download): void {
        $this->Numero_download = $Numero_download;
    }

    /**
     * Imposta l'ID del materiale scaricato.
     * @param int $id_materiale L'ID del materiale scaricato.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }

    /**
     * Imposta l'ID dello studente che ha effettuato il download.
     * @param int $id_studente L'ID dello studente che ha effettuato il download.
     */
    public function setIdStudente(int $id_studente): void {
        $this->id_studente = $id_studente;
    }
    
}