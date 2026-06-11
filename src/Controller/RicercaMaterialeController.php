<?php

namespace Controller;

use Foundation\Persistent\PersistentManager;
use Foundation\Session;
use Foundation\Services\AnteprimaPdfService;
use UI\ViewRicercaMateriale;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
use Model\Studente;
use Model\Recensione;
use Model\Segnalazione;
use Model\File;
use PDOException;
use RuntimeException;
use InvalidArgumentException;

/**
 * RicercaMaterialeController
 *
 * Gestisce:
 * - ricerca per titolo
 * - ricerca per filtri
 * - materiali popolari
 * - preferiti utente
 * - download utente
 * - materiali popolari per utente
 * - paginazione
 */
class RicercaMaterialeController
{
    // MODALITÀ 1 — Ricerca per titolo

    /**
     * Ricerca materiali per titolo.
     *
     * @throws InvalidArgumentException Se il titolo è vuoto.
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function cerca(): void {
        try {
            $view = new ViewRicercaMateriale();
            $titolo = trim($view->getTitolo());
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente, default 1 se non specificata
            if ($titolo === '') {
                throw new InvalidArgumentException("Il termine di ricerca non può essere vuoto.");
            }
            $session = Session::getInstance();
            $session->setSessionElement('ricerca_titolo', $titolo);
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $pm = PersistentManager::getInstance();
            $materiali = $pm->cercaMateriale($titolo, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $session = Session::getInstance();
            $session->setSessionElement('ricerca_titolo', $titolo);
            $id = $session->getSessionElement('studente');
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $view->getDatiFiltro();
            if($id !== null) {
                $studente = $pm->find(Studente::class, $id);
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
    
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante la ricerca: " . $e->getMessage());
    
        }catch (InvalidArgumentException $e) {
            $view->mostraFormErrore("Errore di validazione: " . $e->getMessage());
        
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    public function dettagli(int $id_materiale): void {
        try {

            
            $view = new ViewRicercaMateriale();
            $pm = PersistentManager::getInstance();
            $materiale = $pm->trovaMateriale($id_materiale);
            if(is_resource($materiale['contenutoFile'])) {
                rewind($materiale['contenutoFile']);
                $contenuto = stream_get_contents($materiale['contenutoFile']);
            }
            $file = new File($contenuto, $materiale['mimeTypeFile'], $materiale['dimensioneFile']);
            $base64 = $file->fileToBase64();
            $session = Session::getInstance();
            $id = $session->getSessionElement('studente');
            $studente = $pm->find(Studente::class, $id);
            $view->mostraDettagliMateriale($materiale, $base64, $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente));
        }catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante la ricerca: " . $e->getMessage());
        }catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Restituisce il contenuto binario del PDF di un materiale, servito inline.
     * Usato come sorgente dell'iframe nella pagina di dettaglio: evita di inlineare
     * il PDF in base64 nell'HTML (i data: URI grandi non vengono renderizzati dai browser).
     *
     * @param int $id_materiale
     * @return void
     */
    public function pdf(int $id_materiale): void {
        try {
            $view = new ViewRicercaMateriale();
            $pm = PersistentManager::getInstance();
            $materiale = $pm->trovaMateriale($id_materiale);
            $contenuto = $materiale['contenutoFile'] ?? null;
            if (is_resource($contenuto)) {
                rewind($contenuto);
                $contenuto = stream_get_contents($contenuto);
            }
            $view->mostraPdf($contenuto, $materiale['mimeTypeFile'] ?? null, $id_materiale);
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante il recupero del PDF: " . $e->getMessage());
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i materiali più popolari.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function popolari(): void{
        try {
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1;
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $pm        = PersistentManager::getInstance();
            $materiali = $pm->trovaMaterialiPopolari($arrayPaginazione['offset'], $arrayPaginazione['limit']);
            $session = Session::getInstance();
            $session->setSessionElement('ricerca_titolo', '');
            $id = $session->getSessionElement('studente');
            $studente = $pm->find(Studente::class, $id);
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $view->getDatiFiltro();            
            if($studente !== null) {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
            
            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtri);
            }
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante il recupero dei materiali: " . $e->getMessage());
    
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Applica i filtri alla ricerca corrente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function filtra(): void {
        try {
            $view = new ViewRicercaMateriale();
            $session = Session::getInstance();
            $titolo = $session->getSessionElement('ricerca_titolo') ?? '';
            $nuoviFiltri = $view->getDatiFiltro(); // Filtri inviati dalla UI
            $page = $view->getPage() ?? 1; // Pagina corrente, default 1
            $arrayPaginazione = $this->paginazione(Materiale::class, $page);
            $filtriAttuali = Session::getInstance()->getSessionElement('ricerca_filtri') ?? []; // Recupero i filtri già presenti in sessione
            foreach ($nuoviFiltri as $chiave => $valore) {
                if ($valore === null || $valore === '') {
                    unset($filtriAttuali[$chiave]);
            
                } else {
                    $filtriAttuali[$chiave] = $valore;
                }
            }
            if (($filtriAttuali['tipologia'] ?? null) === 'esame') {
                unset($filtriAttuali['tag']);
            }
            $tipologieValide = ['appunto', 'esame'];
            if (isset($filtriAttuali['tipologia']) && !in_array($filtriAttuali['tipologia'], $tipologieValide, true)) {
                unset($filtriAttuali['tipologia']);
            }
            Session::getInstance()->setSessionElement('ricerca_filtri', $filtriAttuali);
            $pm = PersistentManager::getInstance();
            $materiali = $pm->cercaMateriale(
                $titolo,
                $arrayPaginazione['offset'],
                $arrayPaginazione['limit'],
                $filtriAttuali['insegnamento']         ?? '',
                $filtriAttuali['tipologia']            ?? '',
                $filtriAttuali['corso_di_laurea']      ?? '',
                $filtriAttuali['tag']                  ?? '',
                $filtriAttuali['criterio_ordinamento'] ?? ''
            );

            $id = $session->getSessionElement('studente');
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $studente = $id !== null ? $pm->find(Studente::class, $id) : null;

            if($studente !== null) {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtriAttuali);

            } else {
                $view->mostraMateriali($materiali, $page, $arrayPaginazione['totPage'], null, null, $corsiDiLaurea, $insegnamenti, $filtriAttuali);
            }
    
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore DB durante l'applicazione dei filtri: " . $e->getMessage());
    
        } catch (\Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i materiali preferiti dell’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function preferiti() : void {
        try{
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1; 
        
            $arrayPaginazione = $this->paginazione(Preferito::class, $page); 
        
            $session = Session::getInstance(); 
            $idStudenteLoggato = $session->getSessionElement('studente');
        
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
        
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            $preferiti = $pm->trovaPreferitiPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
            
            $view->mostraMateriali($preferiti, $arrayPaginazione['totPage'], $page, $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i download dell’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function download() : void {
        try{
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente
        
            $arrayPaginazione = $this->paginazione(Download::class, $page); 
            
            $session = Session::getInstance();
            $idStudenteLoggato = $session->getSessionElement('studente');
            
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
            
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            
            $download = $pm->trovaDownloadPerUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        
            $view->mostraMateriali(
                $download,
                $page,
                $arrayPaginazione['totPage'],
                $studente->getUsername(),
                $studente->getImmagineProfilo()->getBase64($studente),
                $corsiDiLaurea,
                $insegnamenti,
                $filtri
            );

        
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Mostra i materiali popolari per l’utente.
     *
     * @throws RuntimeException Se si verifica un errore DB.
     * @return void
     */
    public function popolariUtente() : void {
        try{
            $view = new ViewRicercaMateriale();
            $page = $view->getPage() ?? 1; // Ottieni la pagina corrente
        
            $arrayPaginazione = $this->paginazione(Materiale::class, $page); // Calcola l'offset per la query
        
            $session = Session::getInstance(); // Ottieni l'istanza della sessione
            $idStudenteLoggato = $session->getSessionElement('studente');
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $idStudenteLoggato);
            $corsiDiLaurea = $pm->trovaCorsiDiLaurea();
            $insegnamenti = $pm->trovaInsegnamenti();
            $filtri = $session->getSessionElement('ricerca_filtri') ?? [];
            $materialiPopolari = $pm->MaterialiPopolariUtente($idStudenteLoggato, $arrayPaginazione['offset'], $arrayPaginazione['limit']);
        
            $view->mostraMateriali($materialiPopolari, $page, $arrayPaginazione['totPage'], $studente->getUsername(), $studente->getImmagineProfilo()->getBase64($studente), $corsiDiLaurea, $insegnamenti, $filtri);
    
        } catch (PDOException $e) {
            $view->mostraFormErrore("Errore durante la ricerca: " . $e->getMessage());
        
        } catch (Exception $e) {
            $view->mostraFormErrore("Errore imprevisto: " . $e->getMessage());
        }
    }

    /**
     * Calcola offset, limit e numero totale di pagine.
     *
     * @param string $class
     * @param int $page
     * @return array
     */
    public function paginazione(string $class, int $page) : array {
        $page = max(1, $page); // Assicurati che la pagina sia almeno 1
        $limit = 10; // Numero di risultati per pagina
        $offset = ($page - 1) * $limit; // Calcola l'offset per la query
        $pm = PersistentManager::getInstance();
        $session = Session::getInstance();
        $titolo = $session->getSessionElement('ricerca_titolo') ?? '';
        if($titolo === '') {
            $view = new ViewRicercaMateriale();
            if($view->getDatiFiltro() === []){
                $totaleMateriali = $pm->countAll($class, ['titolo' => '%' . $view->getTitolo() . '%']);
            } else {
                $filtri = $view->getDatiFiltro();
                $totaleMateriali = $pm->countAll($class, [
                'titolo' => '%' . $view->getTitolo() . '%',
                'tipologia' => $filtri['tipologia'] ?? null,
                'corso_di_laurea' => $filtri['corso_di_laurea'] ?? null,
                'insegnamento' => $filtri['insegnamento'] ?? null,
                'tag' => $filtri['tag'] ?? null
                ]);
            }
        } else {
            if($session->getSessionElement('ricerca_filtri') === []) {
                $totaleMateriali = $pm->countAll($class, ['titolo' => '%' . $titolo . '%']);
            
            } else {
                $totaleMateriali = $pm->countAll($class, [
                    'titolo' => '%' . $titolo . '%',
                    'tipologia' => $filtri['tipologia'] ?? null,
                    'corso_di_laurea' => $filtri['corso_di_laurea'] ?? null,
                    'insegnamento' => $filtri['insegnamento'] ?? null,
                    'tag' => $filtri['tag'] ?? null
                ]);
            }
        }
        $totPage = ceil($totaleMateriali / $limit);
    return [
        'offset' =>$offset,
        'limit' => $limit,
        'totPage' => $totPage
    ];
    }
}