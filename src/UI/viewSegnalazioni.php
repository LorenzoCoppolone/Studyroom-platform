<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

/**
 * ViewSegnalazioni
 *
 * Gestisce la UI relativa alle segnalazioni dei materiali:
 * - recupero dati dal form
 * - visualizzazione popup di conferma
 * - visualizzazione errori
 */
class ViewSegnalazioni {

    /**
     * @var Smarty
     */
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Recupera l'ID del materiale dal form.
     *
     * @return int|null
     */
    public function getIdMateriale(): ?int {
        return isset($_POST['idMateriale']) ? (int) $_POST['idMateriale'] : null;
    }

    /**
     * Recupera il motivo della segnalazione dal form.
     *
     * @return string|null
     */
    public function getMotivo(): ?string {
        return isset($_POST['motivo']) ? trim($_POST['motivo']) : null;
    }

    /**
     * Mostra un popup di errore relativo al form.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio): void {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('feedback/error.tpl');
    }

    /**
     * Reindirizza alla pagina di dettaglio del materiale (pattern PRG).
     * L'header di redirect è emesso qui, nella view; il flash message viene
     * impostato in sessione dal controller.
     *
     * @param int $idMateriale Materiale a cui tornare.
     * @return void
     */
    public function redirectMateriale(int $idMateriale): void {
        header('Location: /RicercaMateriale/dettagli/' . $idMateriale);
        exit;
    }
}
