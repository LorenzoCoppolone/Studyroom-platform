<?php
namespace Controller;
use Foundation\Persistent\PersistentManager;
use UI\viewLoginStudente;
use Model\Studente; 

class LoginUtenteController {




    /**
     * Reindirizza l'utente alla pagina di login
     */
    public function richiediLogin(): void {
        try {
            //chiamo la view per mostrare la form di login
            $view = new viewLoginStudente();
            $view->mostraSchermataLogin();
            
        } catch (\Exception $e) {
            // Gestisci l'eccezione, ad esempio loggando l'errore o mostrando un messaggio all'utente
            error_log("Errore durante la richiesta di login: " . $e->getMessage());
            // Puoi anche mostrare una pagina di errore o un messaggio all'utente
        }
        
    }

    /**
     * Verifica le credenziali dell'utente e effettua il login
     */
    public function effettuaLogin(): void  {
        $view = new viewLoginStudente();
        $datiLogin = $view->getDatiLogin();

        try {
            if (empty($datiLogin['email']) || empty($datiLogin['password'])) {
                throw new \Exception("Email e password sono obbligatori.");
            }

            $pm = PersistentManager::getInstance();

            // mi salvo i dati del login in variabili per comodità
            $email = $datiLogin['email'];
            $password = $datiLogin['password'];
            $user = $pm->findOneBy(Studente::class, ["email" => $email, "password" => $password]);
            if (!$user) {
                throw new \Exception("Utente non trovato");
            }

            if ($user->getPassword() !== $password) {
                throw new \Exception("Password errata");
            }
            // Ottengo l'istanza del PersistentManager
            

        } catch (\Exception $e) {
            // Gestisci l'eccezione, ad esempio loggando l'errore o mostrando un messaggio all'utente
            error_log("Errore durante il login: " . $e->getMessage());
            // Puoi anche mostrare una pagina di errore o un messaggio all'utente
        }

    }

    /**
     * Effettua il logout dell'utente (qui o nel controller del profilo)
     */
    public function effettuaLogout(): void {
        // logica per effettuare il logout dell'utente
    }



}