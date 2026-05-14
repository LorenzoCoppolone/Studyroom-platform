<?php

namespace UI;

class viewRicercaMateriale {

// Funzione che restituisce il titolo inserito dall'utente
    public function getTitolo(): string {
        return $_POST['titolo'];
    }

    /**
     * Restituisce i dati inseriti dall'utente nella ricerca
     * 
     * @return array
     */
    public function getDatiFiltro(): array {
        return [
            // prelievo in $_POST dei valori associati alle chiavi sotto elencate
            'titolo' => $_POST['titolo'],
            'insegnamento' => $_POST['insegnamento'],
            'tipologia' => $_POST['tipologia'],
            'corso_di_laurea' => $_POST['corso_di_laurea'],
            'tag' => $_POST['tag'],
            'criterio_ordinamento' => $_POST['criterio']
        ];
    }


    /**
     * Mostra i risultati della ricerca
     * 
     * @return void
     */
    public function mostraMateriali(array $materiale) : void {

    }
     
}