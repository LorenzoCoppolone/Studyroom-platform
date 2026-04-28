<?php

class Insegnamento {
    private int $codiceInsegnamento;
    private string $nomeInsegnamento;

    /** @var Materiale[] */
    private array $materiali = [];

    /**
     * Costruttore di Insegnamento.
     * 
     * @param int $codiceInsegnamento Codice dell'insegnamento.
     * @param string $nomeInsegnamento Nome dell'insegnamento.
     */
    public function __construct(
        int $codiceInsegnamento, 
        string $nomeInsegnamento
        ) {
        $this->codiceInsegnamento = $codiceInsegnamento;
        $this->nomeInsegnamento = $nomeInsegnamento;
    }

    /**
     * Restituisce il codice dell'insegnamento.
     * 
     * @return int
     */
    public function getCodiceInsegnamento(): int {
        return $this->codiceInsegnamento;
    }

    /**
     * Imposta/modifica il codice dell'insegnamento.
     * 
     * @param int $codiceInsegnamento Nuovo codice.
     * @return void
     */
    public function setCodiceInsegnamento(int $codiceInsegnamento): void {
        $this->codiceInsegnamento = $codiceInsegnamento;
    }

    /**
     * Restituisce il nome dell'insegnamento.
     * 
     * @return string
     */
    public function getNomeInsegnamento(): string {
        return $this->nomeInsegnamento;
    }

    /**
     * Imposta/modifica il nome dell'insegnamento.
     * 
     * @param string $nomeInsegnamento Nuovo nome.
     * @return void
     */
    public function setNomeInsegnamento(string $nomeInsegnamento): void {
        $this->nomeInsegnamento = $nomeInsegnamento;
    }

    /**
     * Restituisce la lista dei materiali.
     * 
     * @return Materiale[]
     */
    public function getMateriali(): array {
        return $this->materiali;
    }

    /**
     * Aggiunge un materiale all'insegnamento.
     * 
     * @param Materiale $materiale Materiale da aggiungere.
     * @return void
     */
    public function aggiungiMateriale(Materiale $materiale): void {
        $this->materiali[] = $materiale;
    }

    /**
     * Rimuove un materiale dall'insegnamento.
     * 
     * @param Materiale $materiale Materiale da rimuovere.
     * @return void
     */
    public function rimuoviMateriale(Materiale $materiale): void {
        foreach ($this->materiali as $key => $mat) {
            if ($mat === $materiale) {
                unset($this->materiali[$key]);
            }
        }
        $this->materiali = array_values($this->materiali);
    }
}