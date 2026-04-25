<?php
class LoginUtenteController {





    public function Richiedi_login(): string {
        return "___";
        // logica per richiedere il login dell'utente, mostrando il modulo di login
    }




    public function Effettua_login(string $email, string $password): bool {
        return true;
        // logica per verificare le credenziali dell'utente e effettuare il login
    }




    public function Effettua_logout(): void {
        // logica per effettuare il logout dell'utente
    }



}