<?php
class Recensione {
    private int $id_recensione;
    private float $voto;
    private string $commento;
    private int $id_studente;
    private int $id_materiale;

    /**
     * Costruttore di recensione.
     * @param int $id_recensione ID della recensione.
     * @param float $voto Voto della recensione.
     * @param string $commento Commento della recensione.
     * @param int $id_studente ID dello studente che ha scritto la recensione.
     * @param int $id_materiale ID del materiale recensito.
     */
    public function __construct(int $id_recensione, float $voto, string $commento, int $id_studente, int $id_materiale) {
        $this->id_recensione = $id_recensione;
        $this->voto = $voto;
        $this->commento = $commento;
        $this->id_studente = $id_studente;
        $this->id_materiale = $id_materiale;
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
     * Ottiene l'ID dello studente che ha scritto la recensione.
     * @return int L'ID dello studente che ha scritto la recensione.
     */
    public function getIdStudente(): int {
        return $this->id_studente;
    }

    /**
     * Ottiene l'ID del materiale recensito.
     * @return int L'ID del materiale recensito.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
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
     * Imposta l'ID dello studente che ha scritto la recensione.
     * @param int $id_studente L'ID dello studente che ha scritto la recensione.
     */
    public function setIdStudente(int $id_studente): void {
        $this->id_studente = $id_studente;
    }
     
    /**
     * Imposta l'ID del materiale recensito.
     * @param int $id_materiale L'ID del materiale recensito.
     * Nota: Passare il materiale per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setMateriale_recensito(Materiale &$materiale_recensito): void {
        $this->materiale_recensito = $materiale_recensito;
    }
}