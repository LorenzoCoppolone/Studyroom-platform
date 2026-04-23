<?php
class Preferito {
    private int $id_preferito;
    private int $id_studente;
    private int $id_materiale;

    /**
     * Costruttore di preferito.
     * @param int $id_preferito ID del preferito.
     * @param int $id_studente ID dello studente che ha aggiunto il materiale ai preferiti.
     * @param int $id_materiale ID del materiale aggiunto ai preferiti.
     */
    public function __construct(int $id_preferito, int $id_studente, int $id_materiale) {
        $this->id_preferito = $id_preferito;
        $this->id_studente = $id_studente;
        $this->id_materiale = $id_materiale;
    }

    /**
     * Ottiene l'ID del preferito.
     * @return int L'ID del preferito.
     */
    public function getIdPreferito(): int {
        return $this->id_preferito;
    }

    /**
     * Ottiene l'ID dello studente che ha aggiunto il materiale ai preferiti.
     * @return int L'ID dello studente che ha aggiunto il materiale ai preferiti.
     */
    public function getIdStudente(): int {
        return $this->id_studente;
    }

    /**
     * Ottiene l'ID del materiale aggiunto ai preferiti.
     * @return int L'ID del materiale aggiunto ai preferiti.
     */
    public function getIdMateriale(): int {
        return $this->id_materiale;
    }

    /**
     * Imposta l'ID del preferito.
     * @param int $id_preferito L'ID del preferito.
     */
    public function setIdPreferito(int $id_preferito): void {
        $this->id_preferito = $id_preferito;
    }

    /**
     * Imposta l'ID dello studente che ha aggiunto il materiale ai preferiti.
     * @param int $id_studente L'ID dello studente che ha aggiunto il materiale ai preferiti.
     */
    public function setIdStudente(int $id_studente): void {
        $this->id_studente = $id_studente;
    }

    /**
     * Imposta l'ID del materiale aggiunto ai preferiti.
     * @param int $id_materiale L'ID del materiale aggiunto ai preferiti.
     */
    public function setIdMateriale(int $id_materiale): void {
        $this->id_materiale = $id_materiale;
    }
}