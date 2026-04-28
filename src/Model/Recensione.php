<?php
class Recensione {
    private int $id;
    private float $voto;
    private string $commento;
    
    private Materiale $materiale;
    private Studente $studente

    /**
     * Costruttore di recensione.
     * @param int $id_recensione ID della recensione.
     * @param float $voto Voto della recensione.
     * @param string $commento Commento della recensione.
     * @param Studente $studente  studente che ha scritto la recensione.
     * @param Materiale $materiale materiale recensito.
     */
    public function __construct(
        int $id, 
        float $voto, 
        string $commento, 
        Studente $studente, 
        Materiale $materiale
        ) {
        $this->id = $id;
        $this->voto = $voto;
        $this->commento = $commento;
        $this->studente = $studente;
        $this->materiale = $materiale;

        $materiale->aggiungiRecensione($this);
    }

    /**
     * Ottiene l'ID della recensione.
     * @return int L'ID della recensione.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Ottiene il voto della recensione.
     * @return float Il voto della recensione.
     */
    public function getVoto(): float {
        return $this->voto;
    }

    /**
     * Ottiene il commento della recensione.
     * @return string Il commento della recensione.
     */
    public function getCommento(): string {
        return $this->commento;
    }

    /**
     * Ottiene lo studente che ha scritto la recensione.
     * @return Studente studente che ha scritto la recensione.
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Ottiene il materiale recensito.
     * @return Materiale materiale recensito.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta l'ID della recensione.
     * @param int $id_recensione L'ID della recensione.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Imposta il voto della recensione.
     * @param float $voto Il voto della recensione.
     */
    public function setVoto(float $voto): void {
        $this->voto = $voto;
    }

    /**
     * Imposta il commento della recENSIONE.
     * @param string $commento Il commento della recENSIONE.
     */
    public function setCommento(string $commento): void {
        $this->commento = $commento;
    }

    /**
     * Imposta lo studente che ha scritto la recensione.
     * @param Studente $studente  studente che ha scritto la recensione.
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }
     
    /**
     * Imposta il materiale recensito.
     * @param Materiale $materiale materiale recensito.
     * Nota: Passare il materiale per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setMateriale(Materiale &$materiale_recensito): void {
        $this->materiale_recensito = $materiale_recensito;
    }
    // Che cos'e' &$materiale? Riga 111
}