<?php
namespace Controller;
use Foundation\Persistent\PersistentManager;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class RicercaMaterialeController {


    /**
     * Esegue la ricerca dei materiali in base a un termine di ricerca.
     * @param string $titolo Il titolo del materiale da cercare.
     * @return array Un array di materiali che corrispondono al termine di ricerca.
     * @throws InvalidArgumentException Se il titolo del materiale è vuoto.
     * @throws Exception Se si verifica un errore durante la ricerca dei materiali.
     * @throws PDOException Se si verifica un errore di database durante la ricerca dei materiali.
     * @throws RuntimeException Se si verifica un errore imprevisto durante la ricerca dei materiali.
     */
    public function cercaMaterialePerTitolocontroller(string $titolo): array {
        if (empty($titolo)) {
            throw new InvalidArgumentException("Il titolo del materiale non può essere vuoto.");
        }

        // Logica per cercare i materiali nel database o in un'altra fonte dati
        try {
        $pm = PersistentManager::getInstance(); // Ottieni l'istanza del PersistentManager
        $materiali = $pm->cercaMaterialePerTitolo($titolo);
        return $materiali;

    } catch (PDOException $e) {
        // Errore lato DB
        throw new RuntimeException("Errore durante la ricerca dei materiali: " . $e->getMessage());
    
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
        public function FiltraMaterialecontroller(string $titolo, string $insegnamento, string $tipologia, string $corso_di_laurea, string $tag): array {
            // Logica per cercare i materiali filtrati nel database 
            return [];
        }






        public function OrdinaMateriale(string $ordinamento): array {
            return [];

                // Logica per ordinare i materiali
        }
}