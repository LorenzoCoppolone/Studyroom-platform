<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewRecensioneMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
     }

    /**
    * Restituisce l'ID del materiale su cui l'utente ha cliccato.
    *
    * @return int|null
     */
    public function getIdMateriale() : ?int {
        return $_POST['idMateriale'] ?? null;
    }

    /**
     * Restituisce il voto inserito dall'utente nella recensione.
     *
     * @return float|null
     */
    public function getVoto() : ?float {
        return $_POST['voto'] ?? null;
    }

    /**
     * Restituisce il commento inserito dall'utente nella recensione.
     *
     * @return string|null
     */
    public function getCommento() : ?string {
        return $_POST['commento'] ?? null;
    }

    /**
     * Mostra il form di recensione.
     *
     * @return void
     */
    public function mostraFormRecensione() : void {
        $this->smarty->display('formRecensione.tpl');
    }

    /**
     * Mostra il pop-up di conferma della recensione.
     *
     * @return void
     */
    public function mostraPopUpConfermaRecensione() : void {
        $this->smarty->display('popUpConfermaRecensione.tpl');
    }
}