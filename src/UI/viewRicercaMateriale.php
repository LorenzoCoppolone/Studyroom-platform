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

    /**
     * Mostra la pagina di errore quando il materiale richiesto non esiste,
     * impostando lo stato HTTP 404 (gli header vanno emessi qui, nella view).
     *
     * @return void
     */
    public function mostraMaterialeNonTrovato() : void {
        header('HTTP/1.1 404 Not Found');
        $this->smarty->assign('errore', 'Materiale non trovato');
        $this->smarty->assign('dettaglio', 'Il materiale richiesto non esiste o è stato rimosso.');
        $this->smarty->display('error.tpl');
    }

    public function mostraDettagliMateriale(array $materiale, ?string $username, ?string $base64Studente, bool $preferito = false) : void {
        $this->smarty->assign('materiale', $materiale);
        $this->smarty->assign('studente', $username);
        $this->smarty->assign('base64', $base64Studente);
        $this->smarty->assign('preferito', $preferito);
        $this->smarty->display('dettagliMateriale.tpl');
    }

    /**
     * Invia al browser il contenuto binario di un PDF, servito inline.
     * Emette qui gli header HTTP e l'output (responsabilità della view).
     *
     * @param string|null $contenuto Contenuto binario del file
     * @param string|null $mimeType  Tipo MIME del file
     * @param int $id ID del materiale (usato nel filename)
     * @return void
     */
    public function mostraPdf(?string $contenuto, ?string $mimeType, int $id) : void {
        if (empty($contenuto)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }
        header('Content-Type: ' . ($mimeType ?: 'application/pdf'));
        header('Content-Disposition: inline; filename="materiale-' . $id . '.pdf"');
        header('Content-Length: ' . strlen($contenuto));
        echo $contenuto;
        exit;
    }
}