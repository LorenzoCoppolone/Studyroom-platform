<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class viewHome{

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Metodo di ingresso della Home:
     * reindirizza automaticamente alla dashboard.
     * 
     * @return void
     */
    public function index() : void {
        header("Location: Home/dashboard");
        exit;
    }

    /**
     * Mostra la home page, con o senza utente loggato.
     *
     * @param string|null $username Username dello studente loggato (se presente)
     * @param string|null $base64   Immagine profilo codificata in base64 (se presente)
     * @return void
     */
    public function mostraHome(?string $username, ?string $base64) : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('home.tpl');
    }

    public function getCookieRemember() : string|null {
        return isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] :  null;
    }
}