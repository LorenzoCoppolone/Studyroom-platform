<?php

class CorsoDiLaurea {
    private int $id_corso;
    private string $nome_corso;



    
    /**
     * Costruttore di corso di laurea.
     * 
     * @param int $id_corso ID del corso di laurea.
     * @param string $nome_corso Nome del corso di laurea.
     */
    public function __construct(int $id_corso, string $nome_corso) {
        $this->id_corso = $id_corso;
        $this->nome_corso = $nome_corso;
    }




    /**
     * Ottiene l'ID del corso di laurea.
     * @return int L'ID del corso di laurea.
     */
    public function getId_corso(): int {
        return $this->id_corso;
    }



    /**
     * Imposta l'ID del corso di laurea.
     * @param int $id_corso L'ID del corso di laurea.
     */
    public function setId_corso(int $id_corso): void {
        $this->id_corso = $id_corso;
    }



    /**
     * Ottiene il nome del corso di laurea.
     * @return string Il nome del corso di laurea.
     */

    public function getNome_corso(): string {
        return $this->nome_corso;
    }



    /**
     * Imposta il nome del corso di laurea.
     * @param string $nome_corso Il nome del corso di laurea.
     */
    public function setNome_corso(string $nome_corso): void {
        $this->nome_corso = $nome_corso;
    }
}