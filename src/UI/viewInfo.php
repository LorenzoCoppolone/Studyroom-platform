<?php
namespace UI;

use Smarty\Smarty;
use config\StartSmarty;

class viewInfo {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Mostra la pagina "Chi siamo".
     *
     * @param string|null $username Username dello studente loggato
     * @param string|null $base64   Immagine profilo codificata in base64
     * @return void
     */
    public function chiSiamo(?string $username = null, ?string $base64 = null) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('static/chi-siamo.tpl');
    }

    /**
     * Mostra la pagina "Supporto".
     *
     * @param string|null $username Username dello studente loggato
     * @param string|null $base64   Immagine profilo codificata in base64
     * @return void
     */
    public function supporto(?string $username = null, ?string $base64 = null) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('static/supporto.tpl');
    }

    /**
     * Mostra la pagina "FAQ".
     *
     * @param string|null $username Username dello studente loggato
     * @param string|null $base64   Immagine profilo codificata in base64
     * @return void
     */
    public function faq(?string $username = null, ?string $base64 = null) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('static/faq.tpl');
    }

    /**
     * Mostra la pagina "Termini e condizioni".
     *
     * @param string|null $username Username dello studente loggato
     * @param string|null $base64   Immagine profilo codificata in base64
     * @return void
     */
    public function termini(?string $username = null, ?string $base64 = null) : void {
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('static/termini.tpl');
    }
}
