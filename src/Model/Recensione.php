<?php
class Recensione {
    private int $id_recensione;
    private float $voto;
    private string $commento;
    private Studente $studente_recensore;
    private Materiale $materiale_recensito;

    /**
     * Costruttore di recensione.
     * @param int $id_recensione ID della recensione.
     * @param float $voto Voto della recensione.
     * @param string $commento Commento della recensione.
     * @param Studente $studente_recensore Studente che ha scritto la recensione.
     * @param Materiale $materiale_recensito Materiale recensito.
     */
    public function __construct(int $id_recensione, float $voto, string $commento, Studente $studente_recensore, Materiale $materiale_recensito) {
        $this->id_recensione = $id_recensione;
        $this->voto = $voto;
        $this->commento = $commento;
        $this->studente_recensore = $studente_recensore;
        $this->materiale_recensito = $materiale_recensito;
    }

    /**
     * Ottiene l'ID della recensione.
     * @return int L'ID della recensione.
     */
    public function getIdRecensione(): int {
        return $this->id_recensione;
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
     * @return Studente Lo studente che ha scritto la recensione.
     */
    public function getStudente_recensore(): Studente {
        return $this->studente_recensore;
    }

    /**
     * Ottiene il materiale recensito.
     * @return Materiale Il materiale recensito.
     */
    public function getMateriale_recensito(): Materiale {
        return $this->materiale_recensito;
    }

    /**
     * Imposta l'ID della recensione.
     * @param int $id_recensione L'ID della recensione.
     */
    public function setIdRecensione(int $id_recensione): void {
        $this->id_recensione = $id_recensione;
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
     * @param Studente &$studente Lo studente che ha scritto la recensione.
     * Nota: Passare lo studente per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setStudente_recensore(Studente &$studente_recensore): void {
        $this->studente_recensore = $studente_recensore;
    }
     
    /**
     * Imposta il materiale recensito.
     * @param Materiale &$materiale Il materiale recensito.
     * Nota: Passare il materiale per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setMateriale_recensito(Materiale &$materiale_recensito): void {
        $this->materiale_recensito = $materiale_recensito;
    }
}