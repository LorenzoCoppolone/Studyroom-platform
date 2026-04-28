<?php

class CorsoDiLaurea {
    private int $codiceCorso;
    private string $nomeCorso;

    /** @var Insegnamento[] */
    private array $insegnamenti = [];

    
    /**
     * Costruttore di corso di laurea.
     * 
     * @param int $codiceCorso Codice del corso di laurea.
     * @param string $nomeCorso Nome del corso di laurea.
     */
    public function __construct(
        int $codiceCorso, 
        string $nomeCorso
        ) {
        $this->codiceCorso = $codiceCorso;
        $this->nomeCorso = $nomeCorso;
    }

    /**
     * Restituisce il codice del corso di laurea.
     * 
     * @return int
     */
    public function getCodiceCorso(): int {
        return $this->codiceCorso;
    }

    /**
     * Imposta/modifica il codice del corso di laurea.
     * 
     * @param int $codiceCorso Nuovo codice del corso.
     * @return void
     */
    public function setCodiceCorso(int $codiceCorso): void {
        $this->codiceCorso = $codiceCorso;
    }

    /**
     * Restituisce il nome del corso di laurea.
     * 
     * @return string
     */
    public function getNomeCorso(): string {
        return $this->nomeCorso;
    }

    /**
     * Imposta/modifica il nome del corso di laurea.
     * 
     * @param string $nomeCorso Nuovo nome del corso.
     * @return void
     */
    public function setNomeCorso(string $nomeCorso): void {
        $this->nomeCorso = $nomeCorso;
    }

    /**
     * Restituisce la lista degli insegnamenti.
     * 
     * @return Insegnamento[]
     */
    public function getInsegnamenti(): array {
        return $this->insegnamenti;
    }

    /**
     * Aggiunge un insegnamento al corso di laurea.
     * 
     * @param Insegnamento $insegnamento Insegnamento da aggiungere.
     * @return void
     */
    public function aggiungiInsegnamento(Insegnamento $insegnamento): void {
        $this->insegnamenti[] = $insegnamento;
    }

    /**
     * Rimuove un insegnamento dal corso di laurea.
     * 
     * @param Insegnamento $insegnamento Insegnamento da rimuovere.
     * @return void
     */
    public function rimuoviInsegnamento(Insegnamento $insegnamento): void {
        foreach ($this->insegnamenti as $key => $ins) {
            if ($ins === $insegnamento) {
                unset($this->insegnamenti[$key]);
            }
        }
        // Riordina gli indici
        $this->insegnamenti = array_values($this->insegnamenti);
    }
}