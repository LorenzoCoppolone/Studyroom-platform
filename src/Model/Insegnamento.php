<?php

class Insegnamento {
    private int $Codice_insegnamento;
    private string $nome_insegnamento;
    private int $Codice_corso_di_laurea;
    private int $id_materiale;


    /**
     * Costruttore di insegnamento.
     * 
     * @param int $Codice_insegnamento Codice dell'insegnamento.
     * @param string $nome_insegnamento Nome dell'insegnamento.
     * @param int $Codice_corso_di_laurea Codice del corso di laurea associato all'insegnamento.
     * @param int $id_materiale ID del materiale associato all'insegnamento.
     */
    public function __construct(int $Codice_insegnamento, string $nome_insegnamento, int $Codice_corso_di_laurea, int $id_materiale) {
        $this->Codice_insegnamento = $Codice_insegnamento;
        $this->nome_insegnamento = $nome_insegnamento;
        $this->Codice_corso_di_laurea = $Codice_corso_di_laurea;
        $this->id_materiale = $id_materiale;
    }



    /**
     * Ottiene il codice dell'insegnamento.
     * 
     * @return int Il codice dell'insegnamento.
     */
    public function getCodiceInsegnamento(): int {
        return $this->Codice_insegnamento;
    }



    /**
     * Imposta il codice dell'insegnamento.
     * 
     * @param int $Codice_insegnamento Il codice dell'insegnamento.
     */
    public function setCodiceInsegnamento(int $Codice_insegnamento): void {
        $this->Codice_insegnamento = $Codice_insegnamento;
    }



    /**
     * Ottiene il nome dell'insegnamento.
     * 
     * @return string Il nome dell'insegnamento.
     */
    public function getNomeInsegnamento(): string {
        return $this->nome_insegnamento;
    }



    /**
     * Imposta il nome dell'insegnamento.
     * 
     * @param string $nome_insegnamento Il nome dell'insegnamento.
     */
    public function setNomeInsegnamento(string $nome_insegnamento): void {
        $this->nome_insegnamento = $nome_insegnamento;
    }

    /**
     * Ottiene il codice del corso di laurea associato all'insegnamento.
     * 
     * @return int Il codice del corso di laurea associato all'insegnamento.
     */
    public function getCodiceCorsoDiLaurea(): int {
        return $this->Codice_corso_di_laurea;
    }

    /**
     * Imposta il codice del corso di laurea associato all'insegnamento.
     * 
     * @param int $Codice_corso_di_laurea Il codice del corso di laurea associato all'insegnamento.
     */
    public function setCodiceCorsoDiLaurea(int $Codice_corso_di_laurea): void {
        $this->Codice_corso_di_laurea = $Codice_corso_di_laurea;
    }

    /**
     * Ottiene Id del materiale associato all'insegnamento.
     * 
     * @return int Id del materiale associato all'insegnamento.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }

    /**
     * Imposta il codice del materiale associato all'insegnamento.
     * 
     * @param int $Codice_materiale Il codice del materiale associato all'insegnamento.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }

}