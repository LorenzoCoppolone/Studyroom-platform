<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewCaricaMateriale {

    private Smarty $smarty;
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }


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

        /**
        * Mostra un form con il messaggio di errore all'utente
        * @param string $messaggio
        * @return void
        */
        public function mostraFormErrore(string $messaggio) : void {
            $this->smarty->assign('errore', $messaggio);
            $this->smarty->display('Error.tpl');
        }

        /**
        * Mostra un form con il messaggio di errore all'utente
        * @param string $messaggio
        * @return void
        */
        public function mostraFormSuccesso(string $messaggio) : void {
            $this->smarty->assign('successo', $messaggio);
            $this->smarty->display('materialeCaricato.tpl');
        }


        /**
        * Mostra la form per caricare un materiale
        * @return void
        */
        public function mostraFormCaricaMateriale(array $insegnamenti, array $corsi) : void {
            $this->smarty->assign('insegnamenti', $insegnamenti);
            $this->smarty->assign('corsi', $corsi);
            $this->smarty->display('caricaMateriale.tpl');
        }
}