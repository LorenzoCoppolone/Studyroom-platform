<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewRicercaMateriale {

    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }
// Funzione che restituisce il titolo inserito dall'utente
    public function getTitolo(): string {
        return $_GET['titolo'];
    }

    public function getBottoneCliccato() : string {
        return $_GET['bottone'] ?? '';
    }

     /**
     * Restituisce il token email presente nella query string
     *
    /**
     * Restituisce i dati inseriti dall'utente nella ricerca
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
     * Mostra i risultati della ricerca
     * 
     * @return void
     */
    public function mostraMateriali(array $materiale) : void {
        $this->smarty->assign("materiale", $materiale);
        $this->smarty->display("cercaMateriali.tpl");
    }

    /**
     * Mostra un form con il messaggio di errore all'utente
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('Error.tpl');
    }
     
}