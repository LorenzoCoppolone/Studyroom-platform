<?php
namespace Controller;

use UI\ViewInfo;
use Foundation\Session;
use Model\Studente;
use Foundation\Persistent\PersistentManager;

/**
 * InfoController
 *
 * Gestisce le pagine informative:
 * - Chi siamo
 * - Supporto
 * - FAQ
 * - Termini e condizioni
 *
 * Se l’utente è loggato, passa username e immagine profilo alla view.
 * Se non è loggato, mostra la pagina in versione anonima.
 */
class InfoController {

    /**
     * Mostra la pagina "Chi siamo".
     *
     * @return void
     */
    public function chiSiamo() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        
        if (!isset($studente) || $studente === null) {
            $view = new ViewInfo();
            $view->chiSiamo(null, null);
            exit;
        
        }else {
            $pm = PersistentManager::getInstance();
            
            $studente = $pm->find(Studente::class, $studente);
            $username = $studente->getUsername();
            
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
            
            } else {
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }
            
            $view = new ViewInfo();
            $view->chiSiamo($username, $base64);
        }
    }

    /**
     * Mostra la pagina "Supporto".
     *
     * @return void
     */
    public function supporto() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        
        if (!isset($studente) || $studente === null) {
            $view = new ViewInfo();
            $view->supporto(null, null);
            exit;
        
        }else {
            $pm = PersistentManager::getInstance();
            
            $studente = $pm->find(Studente::class, $studente);
            $username = $studente->getUsername();
        
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
            
            } else {
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }
            
            $view = new ViewInfo();
            $view->supporto($username, $base64);
        }
    }


    /**
     * Mostra la pagina "FAQ".
     *
     * @return void
     */
    public function faq() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        
        if (!isset($studente) || $studente === null) {
            $view = new ViewInfo();
            $view->faq(null, null);
            exit;
    
        }else {
            $pm = PersistentManager::getInstance();
            
            $studente = $pm->find(Studente::class, $studente);
            $username = $studente->getUsername();
            
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
            
            } else {
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }
            
            $view = new ViewInfo();
            $view->faq($username, $base64);
        }
    }

    /**
     * Mostra la pagina "Termini e condizioni".
     *
     * @return void
     */
    public function termini() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        
        if (!isset($studente) || $studente === null) {
            $view = new ViewInfo();
            $view->termini(null, null);
            exit;
        
        }else {
            $pm = PersistentManager::getInstance();
    
            $studente = $pm->find(Studente::class, $studente);
            $username = $studente->getUsername();
    
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
    
            } else {
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }

            $view = new ViewInfo();
            $view->termini($username, $base64);
        }
    }
}
