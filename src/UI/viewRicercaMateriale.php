<?php

namespace UI;

class viewRicercaMateriale {

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

    }

    /**
     * Mostra un form con il messaggio di errore all'utente
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        $smarty = StartSmarty::configuration();
        $smarty->assign('errore', $messaggio);
        $smarty->display('Error.tpl');
    }
     
}