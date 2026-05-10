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


    public function visualizzaProfiloStudente() : void {


        //Andrà gestita la sessione, risvegliandola e recuperando l'id dell'utente 
        //cioè bisognerà capire se un utente ha effettuato il login. 

        $viewProfilo =  new ViewProfiloStudente();

        $dati = $viewProfilo->getDatiStudente();

         try{

        $idStudenteLoggato = $_SESSION['idStudenteLoggato']; // recupero l'id dello studente dalla sessione
        //ANDRANNO RECUPERATI ANCHE OFFSET E LIMITE SE VENGONO GESTITI SERVER SIDE?
        


        $bottone = $dati["bottonePremuto"]; // recupero il bottone premuto dalla view



        // Ottengo l'istanza del PersistentManager
        $pm = PersistentManager::getInstance();


        // recupero ciò che mi serve per la view, a seconda del bottone premuto
        if($bottone == "recensioni"){
        $recensioni = $pm->trovaRecensioniPerUtente($idStudenteLoggato, 0, 10);
        // Mostra le recensioni
        $viewProfilo->mostraRecensioniStudente($recensioni);
        }elseif(strtolower($bottone) === "preferiti"){
        $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, 0, 10);
        // Mostra i preferiti
        $viewProfilo->MostraPreferitiStudente($preferiti);
        }elseif(strtolower($bottone) === "download"){
        $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, 0, 10);
        // Mostra i download
        $viewProfilo->MostraDownloadStudente($download);
        }elseif(strtolower($bottone) === "materiale"){
        $materiale = $pm->MaterialiPopolariUtente($idStudenteLoggato, 0, 10);
        // Mostra i materiali dello studente ordinandoli dal piu' popolare
        $viewProfilo->mostraMaterialiStudente($materiale);
        }

        // gestione eccezioni, va rivista per migliorare la gestione
    }catch(Exception $e){
        echo $e->getMessage();
    }
    }
    
}