<?php

class File{
    private int $id_file;
    private string $url_file;
    private float $Dimensione_file;
    private int $id_materiale;


    
    /**
     * Costruttore di File.
     * @param int $id_file ID del file.
     * @param string $url_file URL del file.
     * @param float $Dimensione_file Dimensione del file in MB.
     * @param int $id_materiale ID del materiale a cui il file è associato.
     */
    public function __construct(int $id_file, string $url_file, float $Dimensione_file, int $id_materiale) {
        $this->id_file = $id_file;
        $this->url_file = $url_file;
        $this->Dimensione_file = $Dimensione_file;
        $this->id_materiale = $id_materiale;
    }



    /**
     * Ottiene l'ID del file.
     * @return int L'ID del file.
     */
    public function getIdFile(): int {
        return $this->id_file;
    }


    
    /**
     * Imposta l'ID del file.
     * @param int $id_file L'ID del file.
     */
    public function setIdFile(int $id_file): void {
        $this->id_file = $id_file;
    }



    /**
     * Ottiene la dimensione del file.
     * @return float La dimensione del file in MB.
     */
    public function getDimensioneFile(): float {
        return $this->Dimensione_file;
    }


    
    /**
     * Imposta la dimensione del file.
     * @param float $Dimensione_file La dimensione del file in MB.
     */
    public function setDimensioneFile(float $Dimensione_file): void {
        $this->Dimensione_file = $Dimensione_file;
    }



    /**
     * Ottiene l'URL del file.
     * @return string L'URL del file.
     */
    public function getUrlFile(): string {
        return $this->url_file; 
    }


    
    /**
     * Imposta l'URL del file.
     * @param string $url_file L'URL del file.
     */
    public function setUrlFile(string $url_file): void {
        $this->url_file = $url_file;
    }

    /**
     * Ottiene l'ID del materiale a cui il file è associato.
     * @return int L'ID del materiale a cui il file è associato.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }

    /**
     * Imposta l'ID del materiale a cui il file è associato.
     * @param int $id_materiale L'ID del materiale a cui il file è associato.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }
}