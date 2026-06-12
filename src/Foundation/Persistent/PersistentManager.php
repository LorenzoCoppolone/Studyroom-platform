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
    private InsegnamentoRepository $insegnamentoRepository;
    // Costruttore privato (Singleton)
    private function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
        $this->adminRepository = new AdminRepository($entityManager);
        $this->materialeRepository = new MaterialeRepository($entityManager);
        $this->utenteRepository = new UtenteRepository($entityManager);
        $this->insegnamentoRepository = new InsegnamentoRepository($entityManager);
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
    public function find(string $class, $id): ?object {
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

public function countAll(string $class, array $criteria = []): int {
    $qb = $this->em->createQueryBuilder();
    $qb->select('COUNT(e)')
       ->from($class, 'e');

    if($class === Download::class){
        if(isset($criteria['materiale'])){
            $qb->join('e.materiale', 'm');
            $qb->andWhere('m.id = :idMateriale')
               ->setParameter('idMateriale', $criteria['materiale']);
            unset($criteria['materiale']);
        }

        if(isset($criteria['utente'])){
            $qb->join('e.utente', 'u');
            $qb->andWhere('u.id = :idUtente')
               ->setParameter('idUtente', $criteria['utente']);
            unset($criteria['utente']);
        }
    }

    if($class === Preferito::class){
        if(isset($criteria['materiale'])){
            $qb->join('e.materiale', 'm');
            $qb->andWhere('m.id = :idMateriale')
               ->setParameter('idMateriale', $criteria['materiale']);
            unset($criteria['materiale']);
        }

        if(isset($criteria['utente'])){
            $qb->join('e.utente', 'u');
            $qb->andWhere('u.id = :idUtente')
               ->setParameter('idUtente', $criteria['utente']);
            unset($criteria['utente']);
        }
    }
    
    if($class === Recensione::class){
        if(isset($criteria['materiale'])){
            $qb->join('e.materiale', 'm');
            $qb->andWhere('m.id = :idMateriale')
               ->setParameter('idMateriale', $criteria['materiale']);
            unset($criteria['materiale']);
        }

        if(isset($criteria['utente'])){
            $qb->join('e.utente', 'u');
            $qb->andWhere('u.id = :idUtente')
               ->setParameter('idUtente', $criteria['utente']);
            unset($criteria['utente']);
        }
    }
    if($class === Materiale::class){
    /*
     * 1) TIPOLGIA (Appunto / Esame)
     */
    if (isset($criteria['tipologia'])) {
        $tipo = strtolower($criteria['tipologia']);
        if ($tipo === 'appunto') {
            $qb->andWhere('e INSTANCE OF Model\Appunto');
        } elseif ($tipo === 'esame') {
            $qb->andWhere('e INSTANCE OF Model\Esame');
        }
        unset($criteria['tipologia']);
    }
    /*
     * 2) INSEGNAMENTO (ManyToOne) → confronto esatto
     */
    if (isset($criteria['insegnamento'])) {
        $qb->join('e.insegnamento', 'i');
        $qb->andWhere('i.nomeInsegnamento = :insegnamento')
           ->setParameter('insegnamento', $criteria['insegnamento']);
        unset($criteria['insegnamento']);
    }
    /*
     * 3) CORSO DI LAUREA (JOIN annidato) → confronto esatto
     */
    if (isset($criteria['corso'])) {
        $qb->join('e.insegnamento', 'i2');
        $qb->join('i2.corsoDiLaurea', 'c');
        $qb->andWhere('c.nomeCorso = :corso')
           ->setParameter('corso', $criteria['corso']);
        unset($criteria['corso']);
    }
    /*
     * 4) CAMPI RELAZIONALI DA ESCLUDERE DAL LIKE
     */
    $relationalFields = ['insegnamento', 'corso', 'corsoDiLaurea'];
    /*
     * 5) CAMPI REALI dell'entità (solo quelli semplici)
     */
    $realFields = array_map(
        fn($prop) => $prop->getName(),
        (new \ReflectionClass($class))->getProperties()
    );
    foreach ($criteria as $field => $value) {
        // ignora campi relazionali
        if (in_array($field, $relationalFields, true)) {
            continue;
        }
        // ignora alias o campi inesistenti
        if (!in_array($field, $realFields, true)) {
            continue;
        }
        // LIKE solo sui campi semplici
        $qb->andWhere("e.$field LIKE :$field")
           ->setParameter($field, $value);
    }
    }
    return (int) $qb->getQuery()->getSingleScalarResult();
}





    // Query custom

    public function cercaMateriale(    
        string $titolo,
        int $offset,
        int $limit,
        ?string $insegnamento = "",
        ?string $tipologia = "",   // "appunto", "esame"
        ?string $corso = "",
        ?string $tag = "",
        ?string $criterio = "",
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

    public function trovaMaterialiPopolari(
        int $offset,
        int $limit
    ): array {
        return $this->materialeRepository->trovaMaterialiPopolari(
            $offset,
            $limit
        );
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

    public function eliminaSegnalazioniAdmin(int $id_materiale): void {
        $this->adminRepository->eliminaSegnalazioni($id_materiale);
    }

    public function trovaInsegnamenti(): array {
        return $this->insegnamentoRepository->trovaInsegnamenti();
    }

    public function trovaCorsiDiLaurea(): array {
        return $this->insegnamentoRepository->trovaCorsiDiLaurea();
    }

    public function trovaMateriale(int $id): array {
        return $this->materialeRepository->dettagliMateriale($id);
    }
}