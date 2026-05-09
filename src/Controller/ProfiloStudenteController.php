<?php
namespace Controller;
use UI\viewProfiloStudente;
use Exception;
use Foundation\Persistent\PersistentManager;

class ProfiloStudenteController {
   
    public function visualizzaProfilo() : void {

        //logica per la visualizzazione del profilo dell'utente

    }

    public function modificaProfilo() : void {
        //logica per la modifica del profilo dell'utente
        //ad esempio se l'utente vuole cambiare il suo username o la sua password

    }

    public function eliminaProfilo() : void {

        //logica per l'eliminazione del profilo dell'utente

    }


    public function visualizzaRecensioni() : void {


        //probabilmente andrà gestita la sessione, 
        //cioè bisognerà capire se un utente ha effettuato il login 

        $viewProfilo =  new ViewProfiloStudente();

       

         try{

        $idStudenteLoggato = $_SESSION['idStudenteLoggato']; // recupero lo studente dalla sessione
        //ANDRANNO RECUPERATI ANCHE OFFSET E LIMITE SE VENGONO GESTITI SERVER SIDE


        // Ottengo l'istanza del PersistentManager
        $pm = PersistentManager::getInstance();


        // Ottengo le recensioni, per l'utente loggato
        $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, 0, 10);

        // Mostra le recensioni
        $viewProfilo->mostraRecensioni($recensioni);


        // logica per ottenere i dati del profilo dell'utente
    }catch(Exception $e){
        echo $e->getMessage();
    }
    }


    
}