<?php
class Preferito {
    private int $id_preferito;
    private Studente $studente_preferito;
    private Materiale $materiale_preferito;

    /**
     * Costruttore di preferito.
     * @param int $id_preferito ID del preferito.
     * @param Studente $studente_preferito Studente che ha aggiunto il materiale ai preferiti.
     * @param Materiale $materiale_preferito Materiale aggiunto ai preferiti.
     */
    public function __construct(int $id_preferito, Studente $studente_preferito, Materiale $materiale_preferito) {
        $this->id_preferito = $id_preferito;
        $this->studente_preferito = $studente_preferito;
        $this->materiale_preferito = $materiale_preferito;
    }

    /**
     * Ottiene l'ID del preferito.
     * @return int L'ID del preferito.
     */
    public function getIdPreferito(): int {
        return $this->id_preferito;
    }

    /**
     * Ottiene lo studente che ha aggiunto il materiale ai preferiti.
     * @return Studente Lo studente che ha aggiunto il materiale ai preferiti.
     */
    public function getStudente_preferito(): Studente {
        return $this->studente_preferito;
    }

    /**
     * Ottiene il materiale aggiunto ai preferiti.
     * @return Materiale Il materiale aggiunto ai preferiti.
     */
    public function getMateriale_preferito(): Materiale {
        return $this->materiale_preferito;
    }

    /**
     * Imposta l'ID del preferito.
     * @param int $id_preferito L'ID del preferito.
     */
    public function setIdPreferito(int $id_preferito): void {
        $this->id_preferito = $id_preferito;
    }

    /**
     * Imposta lo studente che ha aggiunto il materiale ai preferiti.
     * @param Studente &$studente Lo studente che ha aggiunto il materiale ai preferiti.
     * Nota: Passare lo studente per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setStudente_preferito(Studente &$studente_preferito): void {
        $this->studente_preferito = $studente_preferito;
    }

    /**
     * Imposta il materiale aggiunto ai preferiti.
     * @param Materiale &$materiale Il materiale aggiunto ai preferiti.
     * Nota: Passare il materiale per riferimento per evitare problemi di copia dell'oggetto.
     */
    public function setMateriale_preferito(Materiale &$materiale_preferito): void {
        $this->materiale_preferito = $materiale_preferito;
    }
}