<?php
abstract class Materiale {
    // Protected properties
    protected int $id_materiale;
    protected string $Titolo_materiale;
    protected int $id_insegnamento;
    protected int $id_studente;
    protected string $url_file;
    protected float $Dimensione_file;



  /**
     * Costruttore della classe Materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param string $Titolo_materiale Il titolo del materiale.
     * @param int $id_insegnamento L'ID dell'insegnamento associato al materiale.
     * @param int $id_studente L'ID dello studente che ha caricato il materiale.
     * @param string $url_file L'URL del file associato al materiale.
     * @param float $Dimensione_file La dimensione del file associato al materiale.
     */
    public function __construct(int $id_materiale, string $Titolo_materiale, int $id_insegnamento, int $id_studente, string $url_file, float $Dimensione_file) {
        $this->id_materiale = $id_materiale;
        $this->Titolo_materiale = $Titolo_materiale;
        $this->id_insegnamento = $id_insegnamento;
        $this->id_studente = $id_studente;
        $this->url_file = $url_file;
        $this->Dimensione_file = $Dimensione_file;
    }



    /**
     * Ottiene l'ID del materiale.
     * @return int L'ID del materiale.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }




    /**
     * Imposta l'ID del materiale.
     * @param int $id_materiale L'ID del materiale.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }



    /**
     * Ottiene il titolo del materiale.
     * 
     * @return string Il titolo del materiale.
     */
    public function getTitoloMateriale(): string {
        return $this->Titolo_materiale;
    }




    /**
     * Imposta il titolo del materiale.
     * 
     * @param string $Titolo_materiale Il titolo del materiale.
     */
    public function setTitoloMateriale(string $Titolo_materiale): void {
        $this->Titolo_materiale = $Titolo_materiale;
    }

    /**
     * Ottiene l'ID dell'insegnamento associato al materiale.
     * 
     * @return int L'ID dell'insegnamento associato al materiale.
     */
    public function getIdInsegnamento(): int {
        return $this->id_insegnamento;
    }

    /**
     * Imposta l'ID dell'insegnamento associato al materiale.
     * 
     * @param int $id_insegnamento L'ID dell'insegnamento associato al materiale.
     */
    public function setIdInsegnamento(int $id_insegnamento): void {
        $this->id_insegnamento = $id_insegnamento;
    }

    /**
     * Ottiene l'ID dell'utente che ha caricato il materiale.
     * 
     * @return int L'ID dello studente che ha caricato il materiale.
     */
    public function getIdStudente(): int {
        return $this->id_studente;
    }

    /**
     * Imposta l'ID dello studente che ha caricato il materiale.
     * 
     * @param int $id_studente L'ID dello studente che ha caricato il materiale.
     */
    public function setIdStudente(int $id_studente): void {
        $this->id_studente = $id_studente;
    }

    /**
     * Ottiene l'URL del file associato al materiale.
     * 
     * @return string L'URL del file associato al materiale.
     */
    public function getUrlFile(): string {
        return $this->url_file;
    }

    /**
     * Imposta l'URL del file associato al materiale.
     * 
     * @param string $url_file L'URL del file associato al materiale.
     */
    public function setUrlFile(string $url_file): void {
        $this->url_file = $url_file;
    }

    /**
     * Ottiene la dimensione del file associato al materiale.
     * 
     * @return float La dimensione del file associato al materiale.
     */
    public function getDimensioneFile(): float {
        return $this->Dimensione_file;
    }

    /**
     * Imposta la dimensione del file associato al materiale.
     * 
     * @param float $Dimensione_file La dimensione del file associato al materiale.
     */
    public function setDimensioneFile(float $Dimensione_file): void {
        $this->Dimensione_file = $Dimensione_file;
    }
}