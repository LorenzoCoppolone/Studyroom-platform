<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class ViewCaricaMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
    * Mostra un form con il messaggio di errore all'utente
    *
    * @param string $messaggio
    * @return void
    */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('feedback/error.tpl');
    }

    /**
    * Mostra la pagina di successo dopo il caricamento di un materiale.
    * Oltre al bottone "Torna alla home", mostra anche un bottone per
    * tornare al form di caricamento (variabile 'ricarica').
    *
    * @param string $messaggio
    * @return void
    */
    public function mostraFormSuccesso(string $messaggio) : void {
        $this->smarty->assign('successo', $messaggio);
        $this->smarty->assign('ricarica', '/CaricaMateriale/carica');
        $this->smarty->display('feedback/successo.tpl');
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
        $this->smarty->display('materiale/caricaMateriale.tpl');
    }

    public function getIdCorsoDiLaurea() : string {
        return $_POST['cdl'];
    }

    public function getIdInsegnamento() : int {
        return (int)$_POST['insegnamento'];
    }

    public function getTipologia() : string {
        return $_POST['tipo'];
    }

    public function getTitolo() : string {
        return $_POST['titolo'];
    }

    public function getTag() : ?string {
        return $_POST['tag'] ?? null;
    }

    public function getTac() : bool {
        return $_POST['terms'];
    }

    public function getFile() : array {
        return $_FILES['file'];
    }
}