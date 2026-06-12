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
     * Mostra il pop-up di conferma della recensione.
     *
     * @return void
     */
    public function mostraPopUpConfermaRecensione() : void {
        $this->smarty->display('popUpConfermaRecensione.tpl');
    }

    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('feedback/error.tpl');
    }

    /**
     * Restituisce il numero di pagina richiesto per la paginazione.
     *
     * @return int|null
     */
    public function getPagina() : ?int {
        return isset($_GET['pagina']) ? (int)$_GET['pagina'] : null;
    }

    /**
     * Mostra l'elenco di tutte le recensioni di un materiale.
     *
     * @param array $recensioni Recensioni del materiale (username, voto, commento).
     * @param int $totPage Numero totale di pagine.
     * @param int $page Pagina corrente.
     * @param int $idMateriale ID del materiale (per i link di paginazione).
     * @param string|null $username Username dell'utente loggato (navbar).
     * @param string|null $base64 Foto profilo dell'utente loggato (navbar).
     * @return void
     */
    public function mostraRecensioniMateriale(array $recensioni, int $totPage, int $page, int $idMateriale, ?string $username = null, ?string $base64 = null) : void {
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->assign('totPage', $totPage);
        $this->smarty->assign('page', $page);
        $this->smarty->assign('idMateriale', $idMateriale);
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64);
        $this->smarty->display('materiale/recensioniMateriale.tpl');
    }
}