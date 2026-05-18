<?php
namespace UI;

class viewCaricaMateriale {
    
    /**
     * Restituisce i dati del materiale da caricare.
     * @return array array di dati passati da http
     */
    public function getDatiMateriale() : array {
        return [
            'titolo' => $_POST['titolo'],
            'insegnamento' => $_POST['insegnamento'],
            'tipologia' => $_POST['tipologia'],
            'corso_di_laurea' => $_POST['corso_di_laurea'],
            'tag' => $_POST['tag'] ?? null,
            'MimeType' => $_FILES['file']['type'],
            'Contenuto' => file_get_contents($_FILES['file']['tmp_name']),
            'error' => $_FILES['file']['error'],
            'size' => $_FILES['file']['size'],
        ];
    }
}