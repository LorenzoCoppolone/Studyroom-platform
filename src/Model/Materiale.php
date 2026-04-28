<?php
abstract class Materiale {
    // Protected properties
    protected int $id;
    protected string $titolo;
    protected File $file; //relazione 1:1

    /** @var Segnalazione[] */
    protected array $segnalazioni = [];

    /** @var Recensione[] */
    protected array $recensioni = [];

    /** @var Download[] */
    protected array $downloads = [];

    /** @var Preferito[] */
    protected array $preferiti = [];

  /**
     * Costruttore della classe Materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param string $Titolo_materiale Il titolo del materiale.
     * @param File file del materiale
     */
    public function __construct(
        int $id,
        string $titolo, 
        File $file
        ) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->file = $file;
    }

    /**
     * Ottiene l'ID del materiale.
     * @return int L'ID del materiale.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta l'ID del materiale.
     * @param int $id_materiale L'ID del materiale.
     */
    public function setId(int $id): void {
        $this->id= $id;
    }

    /**
     * Ottiene il titolo del materiale.
     * 
     * @return string Il titolo del materiale.
     */
    public function getTitolo(): string {
        return $this->titolo;
    }

    /**
     * Imposta il titolo del materiale.
     * 
     * @param string $Titolo_materiale Il titolo del materiale.
     */
    public function setTitolo(string $titolo): void {
        $this->titolo = $titolo;
    }

    /**
     * Ottiene il file associato al materiale.
     * 
     * @return File $file
     */
    public function getFile(): File {
        return $this->file;
    }

    /**
     * Imposta il file associato al materiale.
     * 
     * @param File $file
     */
    public function setFile(File $file): void {
        $this->file = $file;
    }

    /**
     * Ottiene Segnalazioni
     * @return array Segnalazione
     */
    public function getSegnalazioni() : array {
        return $this->segnalazioni;
    }

    /**
     * Aggiunge Segnalazione
     * @param Segnalazione
     */
    public function aggiungiSegnalazione(Segnalazione $segnalazione): void {
        $this->segnalazioni[] = $segnalazione;
    }

    /**
     * Ottiene Recensioni
     * @return array Recensione
     */
    public function getRecensioni() : array {
       return $this->recensioni;
    }

    /**
     * Aggiunge Recensione
     * @param Recensione
     */
    public function aggiungiRecensione(Recensione $recensione): void {
        $this->recensioni[] = $recensione;
    }

    /**
     * Ottiene Download
     * @return array Download
     */
    public function getDownload() : array {
        return $this->downloads;
    }

    /**
     * Aggiunge Download
     * @param Download
     */
    public function aggiungiDownload(Download $download): void {
        $this->download[] = $download;
    }

    /**
     * Ottiene Preferiti
     * @return array Preferito
     */
    public function getPreferiti() : array {
        return $this->preferiti;
    }

    /**
     * Aggiunge Preferito
     * @param Preferito
     */
    public function aggiungiPreferito(Preferito $preferito): void {
        $this->preferiti[] = $preferito;
    }

    /**
     * Aggiunge una segnalazione al materiale.
     * 
     * @param Segnalazione $segnalazione Segnalazione da aggiungere.
     * @return void
     */
    public function aggiungiSegnalazione(Segnalazione $segnalazione): void {
        $this->segnalazioni[] = $segnalazione;
    }

    /**
     * Aggiunge una recensione al materiale.
     * 
     * @param Recensione $recensione Recensione da aggiungere.
     * @return void
     */
    public function aggiungiRecensione(Recensione $recensione): void {
        $this->recensioni[] = $recensione;
    }

    /**
     * Aggiunge un download al materiale.
     * 
     * @param Download $download Download da aggiungere.
     * @return void
     */
    public function aggiungiDownload(Download $download): void {
        $this->downloads[] = $download;
    }

    /**
     * Aggiunge un preferito al materiale.
     * 
     * @param Preferito $preferito Preferito da aggiungere.
     * @return void
     */
    public function aggiungiPreferito(Preferito $preferito): void {
        $this->preferiti[] = $preferito;
    }
}