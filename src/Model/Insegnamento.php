<?php

class Insegnamento {
    private int $id_insegnamento;
    private string $nome_insegnamento;
    private CorsoDiLaurea $corso_di_laurea;
    private Materiale $materiale;


    /**
     * Costruttore di insegnamento.
     * 
     * @param int $id_insegnamento ID dell'insegnamento.
     * @param string $nome_insegnamento Nome dell'insegnamento.
     * @param int $id_corso ID del corso di laurea associato all'insegnamento.
     * @param int $id_Materiale ID del materiale associato all'insegnamento.
     */
    public function __construct(int $id_insegnamento, string $nome_insegnamento, int $id_corso, int $id_Materiale) {
        $this->id_insegnamento = $id_insegnamento;
        $this->nome_insegnamento = $nome_insegnamento;
        $this->id_corso = $id_corso;
        $this->id_Materiale = $id_Materiale;
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
     * Ottiene il corso di laurea associato all'insegnamento.
     * 
     * @return CorsoDiLaurea Il corso di laurea associato all'insegnamento.
     */
    public function getCorsoDiLaurea(): CorsoDiLaurea {
        return $this->corso_di_laurea;
    }

    /**
     * Imposta il corso di laurea associato all'insegnamento.
     * 
     * @param CorsoDiLaurea $corso_di_laurea Il corso di laurea associato all'insegnamento.
     */
    public function setCorsoDiLaurea(CorsoDiLaurea $corso_di_laurea): void {
        $this->corso_di_laurea = $corso_di_laurea;
    }

    /**
     * Ottiene il materiale associato all'insegnamento.
     * 
     * @return Materiale Il materiale associato all'insegnamento.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta il materiale associato all'insegnamento.
     * 
     * @param Materiale $materiale Il materiale associato all'insegnamento.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }

}