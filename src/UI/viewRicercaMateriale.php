<?php
namespace UI;

class viewRicercaMateriale {

    public function getTitolo(): string {
        return $_POST['titolo'];
    }

    public function mostraMateriali(array $materiali): void {
        // Mostra i materiali trovati nella view
    }

    public function getDatiFiltro(): array {
        return [
            'titolo' => $_POST['titolo'],
            'insegnamento' => $_POST['insegnamento'],
            'tipologia' => $_POST['tipologia'],
            'corso_di_laurea' => $_POST['corso_di_laurea'],
            'tag' => $_POST['tag']
        ];
    }
}