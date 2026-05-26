<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
use Model\Recensione;
use Model\Segnalazione;
class PersistentManager {

    private static ?PersistentManager $instance = null;
    private EntityManagerInterface $em;
    private AdminRepository $adminRepository;
    private MaterialeRepository $materialeRepository;
    private UtenteRepository $utenteRepository;

    // Costruttore privato (Singleton)
    private function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
        $this->adminRepository = new AdminRepository($entityManager);
        $this->materialeRepository = new MaterialeRepository($entityManager);
        $this->utenteRepository = new UtenteRepository($entityManager);
    }

    // Ottieni l'istanza unica
    public static function getInstance(): self {
        if (self::$instance === null) {
            $em = require __DIR__ . '/../../../config/doctrine-bootstrap.php';
            self::$instance = new self($em);
        }
        return self::$instance;
    }

    /**
     * Questa funzione salva un oggetto nel DB
     * @param entity Oggetto da salvare nel DB
     * @return void
     */
    public function save(object $entity): void {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
    * Sincronizza le modifiche pendenti delle entità con il database.
    */
    public function update(): void {
        $this->em->flush();
    }

    /**
     * Elimina un'entità dal database
     * @param entity Oggetto da eliminare dal DB
     * @return void
     */
    public function delete(object $entity): void {
        $this->em->remove($entity);
        $this->em->flush();
    }

    /**
     * Trova un'entità nel DB
     * @param class La classe in cui cercare
     * @param id ID dell'oggetto da cercare
     * @return object|null Restituisce l'oggetto trovato nel DB
     */
    public function find(string $class, int $id): ?object {
        return $this->em->find($class, $id);
    }

    /**
     * Trova tutte le entità
     * @param class La classe in cui cercare
     * @return array Restituisce un array di oggetti
     */
    public function findAll(
        string $class
        ): array {
        return $this->em->getRepository($class)->findAll();
    }

    /**
     * Trova le entità secondo determinati criteri
     * @param class La classe in cui cercare 
     * @param criteria Lista di criteri 
     * @return array Restituisce un array di oggetti
     */
    public function findBy(
        string $class, 
        array $criteria
        ): array {
        return $this->em->getRepository($class)->findBy($criteria);
    }

    /**
     * Trova un'entità secondo determinati criteri
     * @param class La classe in cui cercare
     * @param criteria Lista di criteri
     * @return object Restituisce un oggetto
     */
    public function findOneBy(string $class, array $criteria): ?object {
        return $this->em->getRepository($class)->findOneBy($criteria);
    }

    // Query custom

    public function cercaMateriale(    
        string $titolo,
        int $offset,
        int $limit,
        string $insegnamento = "",
        string $tipologia = "",   // "appunto", "esame"
        string $corso = "",
        string $tag = "",
        string $criterio = "",
    ): array {
        return $this->materialeRepository->cerca(
            $titolo, 
            $offset, 
            $limit, 
            $insegnamento, 
            $tipologia, 
            $corso, 
            $tag, 
            $criterio);
    }
    public function trovaPreferitiPerUtente(int $id_studente, int $offset, int $limit): array {
        return $this->utenteRepository->trovaPreferiti($id_studente, $offset, $limit);
    }
    public function trovaDownloadPerUtente(int $id_studente, int $offset, int $limit): array {
        return $this->utenteRepository->trovaDownload($id_studente, $offset, $limit);
    }
    public function trovaRecensioniPerUtente(int $id_studente, int $offset, int $limit): array {
        return $this->utenteRepository->trovaRecensioni($id_studente, $offset, $limit);
    }

    public function materialiPopolariUtente(int $id_studente, int $offset, int $limit): array {
    return $this->utenteRepository->materialiPopolari($id_studente, $offset, $limit);
    }

    public function trovaSegnalazioniAdmin(int $offset, int $limit): array {
       return $this->adminRepository->trovaSegnalazioni($offset, $limit);
    }

    public function gestisciSegnalazioneMaterialeAdmin(int $id_materiale): array {
        return $this->adminRepository->gestisciSegnalazioneMateriale($id_materiale);
    }
}