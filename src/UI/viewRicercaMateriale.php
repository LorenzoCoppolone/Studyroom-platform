<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewRicercaMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Restituisce il titolo inserito dall'utente nella barra di ricerca.
     *
     * @return string
     */
    public function getTitolo(): string {
        return $_GET['titolo'];
    }

    /**
     * Restituisce il nome del bottone cliccato (es. "cerca", "ordina").
     *
     * @return string
     */
    public function getBottoneCliccato() : string {
        return $_GET['bottone'] ?? '';
    }

    /**
     * Restituisce i dati inseriti dall'utente nella ricerca.
     *
     * @return array
     */
    public function getDatiFiltro(): array {
        return [
            // prelievo in $_GET dei valori associati alle chiavi sotto elencate
            'titolo' => $_GET['titolo'],
            'insegnamento' => $_GET['insegnamento'],
            'tipologia' => $_GET['tipologia'],
            'corso_di_laurea' => $_GET['corso_di_laurea'],
            'tag' => $_GET['tag'],
            'criterio_ordinamento' => $_GET['criterio']
        ];
    }

    /**
     * Mostra i risultati della ricerca dei materiali.
     *
     * @param array $materiale Lista dei materiali trovati
     * @return void
     */
    public function mostraMateriali(array $materiale) : void {
        $this->smarty->assign("materiale", $materiale);
        $this->smarty->display("cercaMateriali.tpl");
    }

    /**
     * Mostra un form con il messaggio di errore all'utente.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('Error.tpl');
    }
     
}