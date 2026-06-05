<?php
namespace Controller;

use UI\viewInfo;
use Foundation\Session;
use Model\Studente;
use Foundation\Persistent\PersistentManager;
class InfoController {

    public function chiSiamo() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        if (!isset($studente) || $studente === null) {
            $view = new viewInfo();
            $view->chiSiamo();
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
            $view = new viewInfo();
            $view->chiSiamo($username, $base64);
        }
    }

    public function supporto() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        if (!isset($studente) || $studente === null) {
            $view = new viewInfo();
            $view->supporto();
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
            $view = new viewInfo();
            $view->supporto($username, $base64);
        }
    }


    public function faq() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        if (!isset($studente) || $studente === null) {
            $view = new viewInfo();
            $view->faq();
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
            $view = new viewInfo();
            $view->faq($username, $base64);
        }
    }

    public function termini() : void {
        $session = Session::getInstance();
        $studente = $session->getSessionElement('studente');
        if (!isset($studente) || $studente === null) {
            $view = new viewInfo();
            $view->termini();
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
            $view = new viewInfo();
            $view->termini($username, $base64);
        }
    }
}
