<?php

class Registrazione_Utente {


    public function Richiedi_registrazione(): string {
        return "___";
        // logica per richiedere la registrazione dell'utente, mostrando il modulo di registrazione
    }




    /**
     * Registra un nuovo utente nel sistema.
     * 
     * @param string $nome Il nome dell'utente da registrare.
     * @param string $cognome Il cognome dell'utente da registrare.
     * @param string $email L'email dell'utente da registrare.
     * @param string $password La password dell'utente da registrare.
     * @return bool True se la registrazione è avvenuta con successo, false altrimenti.
     * @throws InvalidArgumentException Se uno dei parametri è vuoto o non valido.
     * @throws Exception Se si verifica un errore durante la registrazione dell'utente.
     * @throws PDOException Se si verifica un errore di database durante la registrazione dell'utente.
     * @throws RuntimeException Se si verifica un errore imprevisto durante la registrazione dell'utente.
     */
    public function registraUtente(string $nome, string $cognome, string $email, string $password): bool {
        if (empty($nome)) {
            throw new InvalidArgumentException("Il nome dell'utente non può essere vuoto.");
        }
        if (empty($cognome)) {
            throw new InvalidArgumentException("Il cognome dell'utente non può essere vuoto.");
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("L'email dell'utente non è valida.");
        }
        if (empty($password) || strlen($password) < 6) {  // Esempio di validazione della password (minimo 6 caratteri), potrebbe essere più complessa.
            throw new InvalidArgumentException("La password deve essere lunga almeno 6 caratteri.");
        }

        // Logica per registrare l'utente nel database
        try {
            // Codice per inserire l'utente nel database

            // ...

            return true; // Restituisce true se la registrazione è avvenuta con successo

        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la registrazione dell'utente: " . $e->getMessage());
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
    }




    public function InviaEmailConferma(string $email): bool {
        return true;
        // logica per l'invio di un'email di conferma all'indirizzo fornito
        // e restituendo true se l'invio è avvenuto con successo, false altrimenti
    }





    public function ConfermaEmail(string $token): bool {
        return true;
        // logica per confermare l'email dell'utente utilizzando un token di conferma
        // e restituendo true se la conferma è avvenuta con successo, false altrimenti
    }







    public function recuperaPassword(string $email): bool {
        return true;
        // logica per il recupero della password, inviando un'email con le istruzioni per reimpostare la password
        // e restituendo true se l'operazione è avvenuta con successo, false altrimenti
    }





}