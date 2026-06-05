<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewCaricaMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /** -------------------------------------------------------------
     *  SEZIONE 2 — LETTURA DATI DA FORM
     * --------------------------------------------------------------*/

    /**
     * Restituisce i dati del materiale da caricare.
     * 
     * @return array Array di dati passati da http
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

    /** -------------------------------------------------------------
     *  SEZIONE — MESSAGGI DI SISTEMA / FORM DI CARICAMENTO
     * --------------------------------------------------------------*/
    /**
    * Mostra un form con il messaggio di errore all'utente
    *
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
    public function mostraFormCaricaMateriale(array $corsi, array $insegnamenti, ?string $username, ?string $base64) : void {
        $this->smarty->assign('corsi', $corsi);
        $this->smarty->assign('insegnamenti', $insegnamenti);
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('caricaMateriale.tpl');
    }

    public function getIdCorsoDiLaurea() : int {
        return (int)$_POST['corso_di_laurea'];
    }

    public function getIdInsegnamento() : int {
        return (int)$_POST['insegnamento'];
    }

    public function getTipologia() : string {
        return $_POST['tipologia'];
    }

    public function getTitolo() : string {
        return $_POST['titolo'];
    }

    public function getTag() : ?string {
        return $_POST['tag'] ?? null;
    }

    public function getTac() : bool {
        return isset($_POST['tac']);
    }

    public function getFile() : array {
        return $_FILES['file'];
    }
}