<?php
class Preferito {
    private int $id;
    
    private Studente $studente;
    private Materiale $materiale;

    /**
     * Costruttore di preferito.
     * @param int $id ID del preferito.
     * @param Studente $studente studente che ha aggiunto il materiale ai preferiti.
     * @param Materiale $materiale materiale aggiunto ai preferiti.
     */
    public function __construct(
        int $id, 
        Studente $studente, 
        Materiale $materiale
        ) {
        $this->id = $id;
        $this->studente = $studente;
        $this->materiale = $materiale;

        $materiale->aggiungiPreferito($this);
        $studente->aggiungiPreferito($this);
    }

    /**
     * Ottiene l'ID del preferito.
     * @return int L'ID del preferito.
     */
    public function getIdPreferito(): int {
        return $this->id;
    }

    /**
     * Ottiene lo studente che ha aggiunto il materiale ai preferiti.
     * @return Studente studente che ha aggiunto il materiale ai preferiti.
     */
    public function getStudente(): Studente {
        return $this->studente;
    }

    /**
     * Ottiene il materiale aggiunto ai preferiti.
     * @return Materiale materiale aggiunto ai preferiti.
     */
    public function getMateriale(): Materiale {
        return $this->materiale;
    }

    /**
     * Imposta l'ID del preferito.
     * @param int $id L'ID del preferito.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Imposta lo studente che ha aggiunto il materiale ai preferiti.
     * @param Studente $studente lo studente che ha aggiunto il materiale ai preferiti.
     */
    public function setStudente(Studente $studente): void {
        $this->studente = $studente;
    }

    /**
     * Imposta il materiale aggiunto ai preferiti.
     * @param Materiale $materiale materiale aggiunto ai preferiti.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materiale = $materiale;
    }
}