<?php
class CaricaMaterialeController {

    private bool $termini_condizioni; // Variabile per memorizzare se l'utente ha accettato i termini e condizioni

    /**
     * Costruttore della classe Caricamento_Materiale
     * @param bool $termini_condizioni
     */
    public function __construct(bool $termini_condizioni = false) {
        $this->termini_condizioni = $termini_condizioni;
    }


    /**
     * Restituisce lo stato dei termini e condizioni
     * @return bool
     */
    public function getTerminiCondizioni(): bool {
        return $this->termini_condizioni;
    }

    /**
     * Imposta lo stato dei termini e condizioni
     * @param bool $termini_condizioni
     */
    public function setTerminiCondizioni(bool $termini_condizioni): void {
        $this->termini_condizioni = $termini_condizioni;
    }



    /**
     * Richiede il caricamento del materiale, mostrando il modulo di caricamento
     * @return string
     */
    public function Richiedi_caricamento(): string {
        return "__";
        // logica per richiedere il caricamento del materiale, mostrando il modulo di caricamento
    }


    /**
     * Carica il materiale nel sistema
     * @param string $titolo
     * @param string $insegnamento
     * @param string $tipologia
     * @param string $corso_di_laurea
     * @param string $tag
     * @param string $file
     * @param bool $termini_condizioni
     * @return bool
     */
    public function Carica_materiale(string $titolo, string $insegnamento, string $tipologia, string $corso_di_laurea, string $tag, string $file, bool $termini_condizioni): bool {
        return true;
        // logica per caricare il materiale nel sistema
    }


    /**
     * Esegue l'accettazione dei termini e condizioni da parte dell'utente.
     * @return void
     */
    public function Accetta_termini_condizioni(): void {
        $this->termini_condizioni = true;
    }

}

