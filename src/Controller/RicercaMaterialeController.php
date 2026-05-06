<?php
namespace Controller;
use Foundation\Persistent\PersistentManager;
use UI\viewRicercaMateriale;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

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

        // Validazione: controllo che il titolo non sia vuoto
        if (empty($titolo)) {
            throw new InvalidArgumentException("Il titolo del materiale non può essere vuoto!");
        }

        // Interrogo la Foundation e passo i risultati alla view
        try {
        // Ottiengo l'istanza del PersistentManager
        $pm        = PersistentManager::getInstance(); 
        $materiali = $pm->cercaMaterialePerTitolo($titolo);
        
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
        public function filtraMaterialeController(): void {
            // Istanzio la view
            $view = new ViewRicercaMateriale();

            // Chiedo alla view tutti i dati del form filtri
            $dati = $ViewRicercaMateriale->getDatiFiltro();

            // Se l'utente ha selezionato 'Esame' allora il tag non è applicabile -> lo azzeriamo
            if (($dati['tipologia'] ?? null) == 'esame') {
                $dati['tag'] = null;
            }

            // Interrogo la Foundation con i filtri e passo i risultati alla view
            try {
                // Ottiengo l'istanza del PersistentManager
                $pm        = PersistentManager::getInstance(); 
                $materiali = $pm->filtraMateriale(
                    $dati['titolo']           ?? null,
                    $dati['insegnamento']     ?? null,
                    $dati['tipologia']        ?? null,
                    $dati['corso_di_laurea']  ?? null,
                    $dati['tag']              ?? null
                );

                $view->mostraMateriali($materiali);

            } catch (PDOException $e) {
            throw new RuntimeException("Errore DB durante il filtraggio: " . $e->getMessage());

            } catch (\Exception $e) {
            throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
            }
            
        }

        // Ordina i materiali già trovati secondo un criterio scelto dall'utente.
        // @throws RuntimeException Se si verifica un errore DB o imprevisto.
        public function ordinaMaterialeController(): void {
            // Istanzio la view
            $view = new ViewRicercaMateriale();

            // Ottengo il criterio di ordinamento scelto dall'utente
            $ordinamento = $view->getOrdinamento();

            // Validazione del criterio tramite whitelist validation
            // $validi : lista dei soli valori che il controllore accetta
            $validi = ['titolo', 'data', 'downlaod'];
            if(!in_array($ordinamento, $validi, true)) {
                // Uso 'data' come valore di ripiego se il criterio di ordinamento non si trva in $validi
                $ordinamento = 'data';
            }

            // Recupero i materiali con l'ordinamento richiesto
            try {
                $pm        = PersistentManager::getInstance();
                $materiali = $pm->getMaterialeOrdinato($ordinamento);

                $view->mostraMateriali($materiali);

            } catch (PDOException $e) {
                throw new RuntimeException("Errore DB durante l'ordinamento: " . $e->getMessage());
            
            } catch (\Exception $e) {
                throw new RuntimeException("Errore imprevisto: " . $e->getMessage());
        }
              
    }

}