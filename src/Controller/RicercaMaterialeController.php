<?php
namespace Controller;
use Foundation\Persistent\PersistentManager;
use UI\viewRicercaMateriale;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;
use Model\Insegnamento;

class RicercaMaterialeController {

    /**
     * Esegue la ricerca dei materiali in base a un termine di ricerca.
     * @throws InvalidArgumentException Se il titolo del materiale è vuoto.
     * @throws Exception Se si verifica un errore durante la ricerca dei materiali.
     * @throws PDOException Se si verifica un errore di database durante la ricerca dei materiali.
     * @throws RuntimeException Se si verifica un errore imprevisto durante la ricerca dei materiali.
     */
    public function cercaMaterialePerTitoloController(): void {

        // Istanzio la view
        $view = new ViewRicercaMateriale();

        // Chiedo alla view il titolo inserito dall'utente
        $titolo = $view->getTitolo();


        // EVENTUALMENTE SI RECUPERANO ANCHE OFFSET E LIMITE, SE VENGONO GESTITI SERVER SIDE.




        // Interrogo la Foundation e passo i risultati alla view
        try {
        // Ottengo l'istanza del PersistentManager
        $pm        = PersistentManager::getInstance(); 
        $materiali = $pm->CercaMateriale($titolo,0,30); // 0 = offset, 30 = limite, dati finti di esempio
        


        // Salvo il titolo nella sessione, cosi da poterlo recuperare nel controller di filtraggio.
        $_SESSION['Titolo'] = $titolo;



        // Mostra i materiali trovati nella view
        $view->mostraMateriali($materiali);

        } catch (PDOException $e) {
            // Errore lato DB
            throw new RuntimeException("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            // Qualsiasi altro errore
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }

    }





        /**
        * Esegue la ricerca dei materiali filtrata.
        * @param string $titolo Il titolo del materiale da cercare.
        * @param string $insegnamento Il nome dell'insegnamento da cercare.
        * @param string $tipologia La tipologia del materiale da cercare.
        * @param string $corso_di_laurea Il corso di laurea del materiale da cercare.
        * @param string $tag Il tag del materiale da cercare.
        * @return array Un array di materiali che corrispondono ai criteri di ricerca.
        * @throws InvalidArgumentException Se uno dei parametri è vuoto.
        * @throws Exception Se si verifica un errore durante la ricerca dei materiali.
        * @throws PDOException Se si verifica un errore di database durante la ricerca dei materiali.
        * @throws RuntimeException Se si verifica un errore imprevisto durante la ricerca dei materiali.
        */
        public function FiltraMaterialeController(): void {
            // Istanzio la view
            $view = new ViewRicercaMateriale();



            // IL TITOLO VIENE RECUPERATO DALLA SESSIONE
            $titolo = $_SESSION['titolo'];

            // EVENTUALMENTE SI RECUPERANO DALLA SESSIONE ANCHE OFFSET E LIMITE, SE VENGONO GESTITI SERVER SIDE.
            



            // Chiedo alla view tutti i dati del form filtri, eccetto il titolo che viene recuperato dalla sessione
            $dati = $view->getDatiFiltro();




            // Se l'utente ha selezionato 'Esame' allora il tag non è applicabile -> lo azzeriamo
            if (($dati['tipologia'] ?? null) === 'esame') {
                $dati['tag'] = null;
            }

            // Interrogo la Foundation con i filtri e passo i risultati alla view
            try {
                // Ottiengo l'istanza del PersistentManager
                $pm        = PersistentManager::getInstance(); 
                $materiali = $pm->CercaMateriale(
                    $titolo           ?? "",
                    $dati['insegnamento']     ?? "",
                    $dati['tipologia']        ?? "",
                    $dati['corso_di_laurea']  ?? "",
                    $dati['tag']              ?? "",
                    $dati['criterio_ordinamento']      ?? "",
                    0,   //offset e limit da implementare in futuro, o tramite js o server side
                    20
                );

                // Mostra i materiali trovati nella view
                $view->mostraMateriali($materiali);

            } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante il filtraggio: " . $e->getMessage());

            } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
            }
            
        }
}