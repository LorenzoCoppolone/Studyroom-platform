<?php

namespace UI;

Use Smarty\Smarty;
Use config\StartSmarty;

class ViewPreferiti {

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
     * @return int|null ID del materiale oppure null se non presente
     */
    public function getIdMateriale() : ?int{
        return $_POST['idMateriale'] ??null ;
    }

    /**
     * Mostra il pop-up che conferma l'aggiunta del materiale ai preferiti.
     *
     * @return void
    */
    public function mostraPopUpAggiunto() : void {
        $this->smarty->assign('messaggio', "Materiale aggiunto ai preferiti!");
        $this->smarty->assign('tipo', "successo");
        $this->smarty->display('popupPreferiti.tpl');
    }
    

    /**
     * Mostra il pop-up che conferma la rimozione del materiale dai preferiti.
     *
     * @return void
    */
     
    public function mostraPopUpRimosso() : void {
       $this->smarty->assign('messaggio', "Materiale rimosso dai preferiti!");
        $this->smarty->assign('tipo', "erroreo");
      $this->smarty->display('feedback/popup.tpl');
    }

    public function mostraFormErrore(string $errore) : void {
        $this->smarty->assign('errore', $errore);
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
    public function redirectMateriale(int $idMateriale) : void {
        header('Location: /RicercaMateriale/dettagli/' . $idMateriale);
        exit;
    }
}
   