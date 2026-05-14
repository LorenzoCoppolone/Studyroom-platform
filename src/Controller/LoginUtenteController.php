<?php
namespace Controller;

class LoginUtenteController {




    /**
     * Reindirizza l'utente alla pagina di login
     * @return string
     */
    public function Richiedi_login(): string {
        return "___";
        // logica per richiedere il login dell'utente, mostrando il modulo di login
    }



    /**
     * Verifica le credenziali dell'utente e effettua il login
     * @return bool
     */
    public function Effettua_login(): bool {
        return true;
        // logica per verificare le credenziali dell'utente e effettuare il login
    }



    /**
     * Effettua il logout dell'utente
     */
    public function Effettua_logout(): void {
        // logica per effettuare il logout dell'utente
    }



}