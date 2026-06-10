<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;
class viewRicercaMateriale {

    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Restituisce il titolo inserito dall'utente nella barra di ricerca.
     *
     * @return string
     */
    public function getTitolo(): string {
        return $_GET['titolo'] ?? '';
    }

    /**
     * Restituisce il nome del bottone cliccato (es. "cerca", "ordina").
     *
     * @return string
     */
    public function getBottoneCliccato() : string {
        return $_GET['bottone'] ?? '';
    }

    /**
     * Restituisce i dati inseriti dall'utente nella ricerca.
     *
     * @return array
     */
    public function getDatiFiltro(): array {
        return [
            // prelievo in $_GET dei valori associati alle chiavi sotto elencate
            'titolo' => $_GET['titolo'] ?? '',
            'insegnamento' => $_GET['insegnamento'] ?? '',
            'tipologia' => $_GET['tipologia'] ?? '',
            'corso_di_laurea' => $_GET['corsoDiLaurea'] ?? '',
            'tag' => $_GET['tag'] ?? '',
            'criterio_ordinamento' => $_GET['criterio'] ?? ''
        ];
    }

    /**
     * Mostra i risultati della ricerca dei materiali.
     *
     * @param array $materiale Lista dei materiali trovati
     * @param int $page Pagina corrente per la paginazione
     * @return void
     */
    public function mostraMateriali(array $materiali, int $page, int $totPage, ?string $username, ?string $base64, array $corsiDiLaurea, array $insegnamenti, array $filtri) : void {
        $this->smarty->assign("materiali", $materiali);
        $this->smarty->assign("paginaCorrente", $page);
        $this->smarty->assign("totalePagine", $totPage);
        $this->smarty->assign("studente", $username);
        $this->smarty->assign("base64", $base64);
        $this->smarty->assign("corsiDiLaurea", $corsiDiLaurea);
        $this->smarty->assign("insegnamenti", $insegnamenti);
        $this->smarty->assign("filtri", $filtri);
        $this->smarty->display("ricercaMateriale.tpl");
    }

    /**
     * Mostra un form con il messaggio di errore all'utente.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio) : void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('error.tpl');
    }
    
    public function getPage(): ?int {
        return isset($_GET['page']) ? (int)$_GET['page']: null;
    }
}