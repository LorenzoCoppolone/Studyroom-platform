<?php
namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class viewAdmin {
    
    private Smarty $smarty;
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }
    /**
     * Restituisce i dati POST inviati dal form gestisciSegnalazione.
     * @return array
     */
    public function getDatiSegnalazione() : array {
        return [
            'bottonePremuto'      => $_POST['bottonePremuto']      ?? '',
            'idMaterialeSegnalato'=> (int)($_POST['idMaterialeSegnalato'] ?? 0),
            'idUtente'            => (int)($_POST['idUtente']            ?? 0),
        ];
    }

    /**
     * Mostra la dashboard admin con la lista dei materiali segnalati.
     * @param array $segnalazioni
     * @return void
     */
    public function mostraDashboardAdmin(array $segnalazioni): void {
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->display('dashboardAdmin.tpl');
    }

    /**
     * Mostra la pagina di gestione di una singola segnalazione.
     * Ristruttura i dati flat del repository in array $materiale e $utente per il template.
     * Il contenuto binario del file viene incorporato direttamente come data URI base64.
     * @param array $dati Riga restituita da gestisciSegnalazioneMateriale()
     * @return void
     */
    public function mostraGestisciSegnalazione(array $dati): void {
        if (!empty($dati)) {
            $r        = $dati[0];
            $mimeType = $r['mimeTypeFile'] ?? null;

            // Incorpora il contenuto del file come data URI base64 (nessun endpoint esterno).
            $fileSrc = null;
            if (!empty($r['contenutoFile']) && $mimeType !== null) {
                $fileSrc = 'data:' . $mimeType . ';base64,' . base64_encode($r['contenutoFile']);
            }

            $this->smarty->assign('materiale', [
                'idMateriale' => $r['idMateriale'],
                'titolo'      => $r['titoloMateriale'],
                'mimeType'    => $mimeType,
                'isImage'     => $mimeType !== null && str_starts_with($mimeType, 'image/'),
                'fileSrc'     => $fileSrc,
            ]);
            $this->smarty->assign('utente', [
                'id'       => $r['idStudente'],
                'nome'     => $r['nomeStudente'],
                'cognome'  => $r['cognomeStudente'],
                'username' => $r['usernameStudente'],
                'email'    => $r['emailStudente'],
            ]);
        }
        $this->smarty->display('gestisciSegnalazione.tpl');
    }

    /**
     * Redireziona alla dashboard admin dopo un'azione riuscita.
     * @return void
     */
    public function mostraSuccesso(): void {
        header('Location: /admin/dashboard');
        exit;
    }

    /**
     * Mostra una pagina di errore.
     * @param string $messaggio
     * @return void
     */
    public function mostraErrore(string $messaggio): void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('error.tpl');
    }
}