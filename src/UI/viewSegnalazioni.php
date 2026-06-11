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

    /**
     * Costruttore: inizializza Smarty.
     */
    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $this->smarty->setCompileDir(__DIR__ . '/../../templates_c/');
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
     * Mostra il popup di conferma dopo l'invio della segnalazione.
     *
     * @return void
     */
    public function mostraConfermaSegnalazione(): void {
        $this->smarty->assign('messaggio', "Segnalazione inviata con successo!");
        echo $this->smarty->fetch('popupSegnalazione.tpl');
    }

    /**
     * Mostra un popup di errore generico.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraErrore(string $messaggio): void {
        $this->smarty->assign('messaggio', $messaggio);
        echo $this->smarty->fetch('popupSegnalazioneErrore.tpl');
    }

    /**
     * Mostra un popup di errore relativo al form.
     *
     * @param string $messaggio
     * @return void
     */
    public function mostraFormErrore(string $messaggio): void {
        $this->smarty->assign('messaggio', $messaggio);
        echo $this->smarty->fetch('popupSegnalazioneErrore.tpl');
    }
}
