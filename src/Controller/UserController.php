<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use UI\viewUser;
use Model\Studente;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class UserController {


    // Funzione per gestire la registrazione di un nuovo utente ( manca la parte relativa ai token 
    // di conferma email e la pagine all ' indirizzamento alla pagina di login dopo la registrazione )

    public function registrazioneUtente() {

        // Istanzio la view e mi faccio restituire la form di registrazione
        $view = new viewUser();
        $view->mostraFormRegistrazione();

        //prelevo i dati inseriti nella form di registrazione
        $datiRegistrazione = $view->getDatiRegistrazione();
        

         try {

            // Istanzio il PersistentManager
            $pm = PersistentManager::getInstance();


            // Controllo che tutti i campi  siano stati compilati
            if (empty($datiRegistrazione['nome']))     throw new \Exception("Il nome è obbligatorio.");
            if (empty($datiRegistrazione['cognome']))  throw new \Exception("Il cognome è obbligatorio.");
            if (empty($datiRegistrazione['username']))    throw new \Exception("L'username è obbligatorio.");
            if (empty($datiRegistrazione['email'])) throw new \Exception("L'email è obbligatoria.");
            if (empty($datiRegistrazione['password'])) throw new \Exception("La password è obbligatoria.");

            // Validazione email
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@studenti\.univaq\.it$/', $datiRegistrazione['email'])) {
                 throw new \Exception("Devi usare la tua email universitaria (@studenti.univaq.it).");
}
         
            // Verifico che email e username non esistano già nel DB ( username puo essere uguale ?)
            $emailEsistente = $pm->findOneBy(Studente::class, [
                'email' => $datiRegistrazione['email']
            ]);
            if ($emailEsistente !== null) {
                throw new \Exception("Email già registrata.");
            }

            $usernameEsistente = $pm->findOneBy(Studente::class, [
                'username' => $datiRegistrazione['username']
            ]);
            if ($usernameEsistente !== null) {
                throw new \Exception("Username già in uso.");
            }

            // 4. Creo l'oggetto

            // Hash della password prima di salvarla nel database
            $passwordHash = password_hash($datiRegistrazione['password'], PASSWORD_BCRYPT);
            $studente = new Studente($datiRegistrazione['nome'], $datiRegistrazione['cognome'],
            $datiRegistrazione['username'] ,$datiRegistrazione['email'], $passwordHash);
            

            // 5. Salvo tramite PersistentManager
            $pm->save($studente);

        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

        // Reindirizzo alla pagina di login o alla home page dopo la registrazione
    }

    //Funzione per gestire il login dell'utente

    public function loginUtente() {

        // Implementazione della logica di login ( simile alla registrazione ma con controlli diversi )

    }
      
   

}
