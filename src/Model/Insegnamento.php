<?php

class Insegnamento {
    private int $id_insegnamento;
    private string $nome_insegnamento;
    private int $id_corso_di_laurea;
    private int $id_materiale;


    /**
     * Costruttore di insegnamento.
     * 
     * @param int $id_insegnamento ID dell'insegnamento.
     * @param string $nome_insegnamento Nome dell'insegnamento.
     * @param int $id_corso_di_laurea ID del corso di laurea associato all'insegnamento.
     * @param int $id_materiale ID del materiale associato all'insegnamento.
     */
    public function __construct(int $id_insegnamento, string $nome_insegnamento, int $id_corso_di_laurea, int $id_materiale) {
        $this->id_insegnamento = $id_insegnamento;
        $this->nome_insegnamento = $nome_insegnamento;
        $this->id_corso_di_laurea = $id_corso_di_laurea;
        $this->id_materiale = $id_materiale;
    }



    /**
     * Ottiene l'ID dell'insegnamento.
     * 
     * @return int L'ID dell'insegnamento.
     */
    public function getIdInsegnamento(): int {
        return $this->id_insegnamento;
    }



    /**
     * Imposta l'ID dell'insegnamento.
     * 
     * @param int $id_insegnamento L'ID dell'insegnamento.
     */
    public function setIdInsegnamento(int $id_insegnamento): void {
        $this->id_insegnamento = $id_insegnamento;
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
     * Ottiene l'ID del corso di laurea associato all'insegnamento.
     * 
     * @return int L'ID del corso di laurea associato all'insegnamento.
     */
    public function getIdCorsoDiLaurea(): int {
        return $this->id_corso_di_laurea;
    }

    /**
     * Imposta l'ID del corso di laurea associato all'insegnamento.
     * 
     * @param int $id_corso_di_laurea L'ID del corso di laurea associato all'insegnamento.
     */
    public function setIdCorsoDiLaurea(int $id_corso_di_laurea): void {
        $this->id_corso_di_laurea = $id_corso_di_laurea;
    }

    /**
     * Ottiene l'ID del materiale associato all'insegnamento.
     * 
     * @return int L'ID del materiale associato all'insegnamento.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }

    /**
     * Imposta l'ID del materiale associato all'insegnamento.
     * 
     * @param int $id_materiale L'ID del materiale associato all'insegnamento.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }

}