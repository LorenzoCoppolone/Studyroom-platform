<?php
abstract class Materiale {
    private int $id_materiale;
    private string $Titolo_materiale;
    private Insegnamento $insegnamento_materiale;
    private Utente $possessore_materiale;
    private File $file;



  /**
     * Costruttore della classe Materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param string $Titolo_materiale Il titolo del materiale.
     * @param Insegnamento $insegnamento_materiale L'insegnamento associato al materiale.
     * @param Utente $possessore_materiale L'utente che ha caricato il materiale.
     * @param File $file Il file associato al materiale.
     */
    public function __construct(int $id_materiale, string $Titolo_materiale, Insegnamento $insegnamento_materiale, Utente $possessore_materiale, File $file) {
        $this->id_materiale = $id_materiale;
        $this->Titolo_materiale = $Titolo_materiale;
        $this->insegnamento_materiale = $insegnamento_materiale;
        $this->possessore_materiale = $possessore_materiale;
        $this->file = $file;
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
     * Ottiene l'insegnamento associato al materiale.
     * 
     * @return Insegnamento L'insegnamento associato al materiale.
     */
    public function getInsegnamento(): Insegnamento {
        return $this->insegnamento;
    }

    /**
     * Imposta l'insegnamento associato al materiale.
     * 
     * @param Insegnamento $insegnamento L'insegnamento associato al materiale.
     */
    public function setInsegnamento(Insegnamento $insegnamento_materiale): void {
        $this->insegnamento = $insegnamento_materiale;
    }

    /**
     * Ottiene l'utente che ha caricato il materiale.
     * 
     * @return Utente L'utente che ha caricato il materiale.
     */
    public function getUtente(): Utente {
        return $this->possessore_materiale;
    }

    /**
     * Imposta l'utente che ha caricato il materiale.
     * 
     * @param Utente $utente L'utente che ha caricato il materiale.
     */
    public function setUtente(Utente $utente): void {
        $this->possessore_materiale = $utente;   
    }

    /**
     * Ottiene il file associato al materiale.
     * 
     * @return File Il file associato al materiale.
     */
    public function getFile(): File {
        return $this->file;
    }

    /**
     * Imposta il file associato al materiale.
     * 
     * @param File $file Il file associato al materiale.
     */
    public function setFile(File $file): void {
        $this->file = $file;
    }
}