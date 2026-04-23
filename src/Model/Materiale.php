<?php
abstract class Materiale {
    private int $id_materiale;
    private string $Titolo_materiale;
    private int $id_insegnamento;
    private int $id_utente;
    private int $id_file;



  /**
     * Costruttore della classe Materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param string $Titolo_materiale Il titolo del materiale.
     * @param int $id_insegnamento L'ID dell'insegnamento associato al materiale.
     * @param int $id_utente L'ID dell'utente che ha caricato il materiale.
     * @param int $id_file L'ID del file associato al materiale.
     */
    public function __construct(int $id_materiale, string $Titolo_materiale, int $id_insegnamento, int $id_utente, int $id_file) {
        $this->id_materiale = $id_materiale;
        $this->Titolo_materiale = $Titolo_materiale;
        $this->id_insegnamento = $id_insegnamento;
        $this->id_utente = $id_utente;
        $this->id_file = $id_file;
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
     * @return int L'ID dell'utente che ha caricato il materiale.
     */
    public function getIdUtente(): int {
        return $this->id_utente;
    }

    /**
     * Imposta l'ID dell'utente che ha caricato il materiale.
     * 
     * @param int $id_utente L'ID dell'utente che ha caricato il materiale.
     */
    public function setIdUtente(int $id_utente): void {
        $this->id_utente = $id_utente;
    }

    /**
     * Ottiene l'ID del file associato al materiale.
     * 
     * @return int L'ID del file associato al materiale.
     */
    public function getIdFile(): int {
        return $this->id_file;
    }

    /**
     * Imposta l'ID del file associato al materiale.
     * 
     * @param int $id_file L'ID del file associato al materiale.
     */
    public function setIdFile(int $id_file): void {
        $this->id_file = $id_file;
    }
}