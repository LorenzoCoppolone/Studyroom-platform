<?php
abstract class Materiale {
    // Protected properties
    protected int $id;
    protected string $titolo;
    protected Insegnamento $insegnamento;
    protected Studente $studente;
    protected File $file;


  /**
     * Costruttore della classe Materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param string $Titolo_materiale Il titolo del materiale.
     * @param int $id_insegnamento L'ID dell'insegnamento associato al materiale.
     * @param int $id_studente L'ID dello studente che ha caricato il materiale.
     * @param string $url_file L'URL del file associato al materiale.
     * @param float $Dimensione_file La dimensione del file associato al materiale.
     */
    public function __construct(
        int $id,
        string $titolo, 
        Insegnamento $insegnamento, 
        Studente $studente, 
        File $file
        ) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->insegnamento = $insegnamento;
        $this->studente = $studente;
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
     * Restituisce l'insegnamento associato al materiale.
     * 
     * @return Insegnamento
     */
    public function getInsegnamento(): Insegnamento {
        return $this->insegnamento;
    }

    /**
     * Imposta l'insegnamento associato al materiale.
     * 
     * @param Insegnamento $insegnamento
     */
    public function setInsegnamento(Insegnamento $insegnamento): void {
        $this->insegnamento = $insegnamento;
    }

    /**
     * Restituisce lo studente che ha caricato il materiale.
     * 
     * @return Studente
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Imposta lo studente associato al materiale.
     * 
     * @param Studente $studente
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
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

}