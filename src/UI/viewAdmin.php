<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewAdmin {
    
    /** @var Smarty Istanza Smarty per la gestione dei template */
    private Smarty $smarty;

    /**
     * Costruttore: inizializza Smarty tramite configurazione centralizzata.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /** -------------------------------------------------------------
     *  SEZIONE — LETTURA DATI DA FORM
     * --------------------------------------------------------------*/
    
    /**
     * Restituisce i dati POST inviati dal form gestisciSegnalazione.
     *
     * @return array
     */
    public function getDatiSegnalazione() : array {
        return [
            'bottonePremuto'      => $_POST['bottonePremuto']      ?? '',
            'idMaterialeSegnalato'=> (int)($_POST['idMaterialeSegnalato'] ?? 0),
            'idUtente'            => (int)($_POST['idUtente']            ?? 0),
        ];
    }

    /** -------------------------------------------------------------
     *  SEZIONE — DASHBOARD E LISTE
     * --------------------------------------------------------------*/
    /**
     * Mostra la dashboard admin con la lista dei materiali segnalati.
     * 
     * @param array $segnalazioni
     * @return void
     */
    public function mostraDashboardAdmin(array $segnalazioni, int $page, int $totPage): void {
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->assign('page', $page);
        $this->smarty->assign('totPage', $totPage);
        $this->smarty->display('admin/dashboardAdmin.tpl');
    }

    /** -------------------------------------------------------------
     *  SEZIONE — GESTIONE SINGOLA SEGNALAZIONE
     * --------------------------------------------------------------*/
    
    /**
     * Mostra la pagina di gestione di una singola segnalazione.
     * Ristruttura i dati flat del repository in array $materiale e $utente per il template.
     * Il contenuto binario del file viene incorporato direttamente come data URI base64.
     * 
     * @param array $dati Riga restituita da gestisciSegnalazioneMateriale()
     * @return void
     */
    public function mostraGestisciSegnalazione(array $dati): void {
            $this->smarty->assign('materiale', [
                'idMateriale' => $dati['idMateriale'],
                'titolo'      => $dati['titoloMateriale'],
            ]);
            $this->smarty->assign('utente', [
                'id'       => $dati['idStudente'],
                'nome'     => $dati['nomeStudente'],
                'cognome'  => $dati['cognomeStudente'],
                'username' => $dati['usernameStudente'],
                'email'    => $dati['emailStudente'],
            ]);        
        $this->smarty->display('admin/gestisciSegnalazione.tpl');
    }

    /** -------------------------------------------------------------
     *  SEZIONE — REDIRECT E MESSAGGI DI SISTEMA
     * --------------------------------------------------------------*/

    /**
     * Redireziona alla dashboard admin dopo un'azione riuscita.
     * 
     * @return void
     */
    public function mostraSuccesso(): void {
        header('Location: /admin/dashboard');
        exit;
    }

    /**
     * Mostra una pagina di errore.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraErrore(string $messaggio): void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('error.tpl');
    }

    /**
     * Mostra una pagina 404.
     *
     * @return void
     */
    public function mostra404(): void {
        header('HTTP/1.1 404 Not Found');
    }

    public function getPage(): int {
        return (int)($_GET['page'] ?? 1);
    }
}