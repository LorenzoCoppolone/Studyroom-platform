<?php
class Download {
    private int $id_download;
    private int $Numero_download;
    private Materiale $materiale;
    private Studente $Studente_download;

    /**
     * Costruttore di download.
     * @param int $id_download ID del download.
     * @param int $Numero_download Numero di download.
     * @param Materiale $materiale Materiale scaricato.
     * @param Studente $Studente_download Studente che ha effettuato il download.
     */
    public function __construct(int $id_download, int $Numero_download, Materiale $materiale, Studente $Studente_download) {
        $this->id_download = $id_download;
        $this->Numero_download = $Numero_download;
        $this->materiale = $materiale;
        $this->Studente_download = $Studente_download;
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
     * Ottiene il materiale scaricato.
     * @return Materiale Il materiale scaricato.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Ottiene lo studente che ha effettuato il download.
     * @return Studente Lo studente che ha effettuato il download.
     */
    public function getStudenteDownload(): Studente {
        return $this->Studente_download;
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
     * Imposta il materiale scaricato.
     * @param Materiale $materiale Il materiale scaricato.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

    /**
     * Imposta lo studente che ha effettuato il download.
     * @param Studente $Studente_download Lo studente che ha effettuato il download.
     */
    public function setStudenteDownload(Studente $Studente_download): void {
        $this->Studente_download = $Studente_download;
    }
    
}