<?php

class CorsoDiLaurea {
    private int $Codice_corso_di_laurea;
    private string $nome_corso;



    
    /**
     * Costruttore di corso di laurea.
     * 
     * @param int $Codice_corso_di_laurea Codice del corso di laurea.
     * @param string $nome_corso Nome del corso di laurea.
     */
    public function __construct(int $Codice_corso_di_laurea, string $nome_corso) {
        $this->Codice_corso_di_laurea = $Codice_corso_di_laurea;
        $this->nome_corso = $nome_corso;
    }




    /**
     * Ottiene il codice del corso di laurea.
     * @return int Il codice del corso di laurea.
     */
    public function getCodice_corso_di_laurea(): int {
        return $this->Codice_corso_di_laurea;
    }



    /**
     * Imposta il codice del corso di laurea.
     * @param int $Codice_corso_di_laurea Il codice del corso di laurea.
     */
    public function setCodice_corso_di_laurea(int $Codice_corso_di_laurea): void {
        $this->Codice_corso_di_laurea = $Codice_corso_di_laurea;
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