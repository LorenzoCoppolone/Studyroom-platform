
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
        $this->smarty->display('recensioniMateriale.tpl');
    }

