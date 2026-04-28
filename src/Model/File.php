<?php

class File{

private string $urlFile;
private float $dimensioneFile;

    /**
     * Costruttore di file.
     * 
     * @param string $urlFile URL del file.
     * @param float $dimensioneFile Dimensione del file in megabyte.
     */
    public function __construct(
        string $urlFile, 
        float $dimensioneFile
        ) {
        $this->urlFile = $urlFile;
        $this->dimensioneFile = $dimensioneFile;
    }

    /**
     * Ottiene l'URL del file.
     * 
     * @return string L'URL del file.
     */
    public function getUrlFile(): string {
        return $this->urlFile;
    }

    /**
     * Imposta l'URL del file.
     * 
     * @param string $url_file L'URL del file.
     */
    public function setUrlFile(string $urlFile): void {
        $this->urlFile = $urlFile;
    }

    /**
     * Ottiene la dimensione del file.
     * 
     * @return float La dimensione del file in megabyte.
     */
    public function getDimensioneFile(): float {
        return $this->dimensioneFile;
    }

    /**
     * Imposta la dimensione del file.
     * 
     * @param float $Dimensione_file La dimensione del file in megabyte.
     */
    public function setDimensioneFile(float $dimensioneFile): void {
        $this->dimensioneFile = $dimensioneFile;
    }

}