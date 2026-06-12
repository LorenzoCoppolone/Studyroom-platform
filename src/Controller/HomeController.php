<?php

namespace Controller;

use UI\viewHome;
use Foundation\Session;
use Foundation\Persistent\PersistentManager;
use Model\Studente;
/**
 * HomeController
 *
 * Gestisce la dashboard e la logica di auto-login tramite cookie "remember me".
 */
class HomeController{

    /**
     * Mostra la dashboard dell'utente.
     * Se non loggato, tenta il login tramite cookie "remember_me".
     *
     * @return void
     */
    public function dashboard() : void {
        $view = new viewHome();
        $session = Session::getInstance();
        $user = $session->getSessionElement('studente');
        
        // AUTO-LOGIN TRAMITE COOKIE REMEMBER ME
        if(($user === null) && ($view->getCookieRemember() !== null)) {
            
            $pm = PersistentManager::getInstance();
            $hashToken = hash('sha256', $view->getCookieRemember());
            $user = $pm->findOneBy(Studente::class, ['rememberMeToken' => $hashToken]);
            
            $tokenTime = $user->getRememberTokenTime(); 
            $tokenTimestamp = $tokenTime->getTimestamp();
            
            // Token scaduto
            if ((time() - $tokenTimestamp) > 0) {
                
                $user->setRememberToken(null);
                $user->setRememberTokenTime(null);
                
                $pm->update($user);
            
            } else {
                // Token valido -> rinnovo
                $user->setRememberTokenTime((new \DateTime('now', new \DateTimeZone('Europe/Rome')))->modify('+30 days'));
                $cookieValue = bin2hex(random_bytes(32));
                setcookie('remember_me', $cookieValue, time() + 60 * 60 * 24 * 30, "/", "", true, true);
                
                $hashToken = hash('sha256', $cookieValue);
                $user->setRememberToken($hashToken);
                
                $pm->update($user);
                
                $session->setSessionElement('studente', $user->getId());
            }
        }
        
        // SE L'UTENTE NON È LOGGATO → HOME ANONIMA
        $idStudente = $session->getSessionElement('studente');
        
        if ($idStudente === null) {
            $view->mostraHome(null, null);
            exit;
        
        }else {
            $pm = PersistentManager::getInstance();
            
            $studente = $pm->find(Studente::class, $idStudente);
            $username = $studente->getUsername();
            
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
            
            } else {
                $base64 = $studente->getImmagineProfilo()->getBase64($studente);
            }
            $view->mostraHome($username, $base64);
        }
    }

    /**
     * Metodo di ingresso della home.
     * Reindirizza alla dashboard.
     *
     * @return void
     */
    public function index() : void {
        $view = new viewHome();
        $view->index();
    }
}