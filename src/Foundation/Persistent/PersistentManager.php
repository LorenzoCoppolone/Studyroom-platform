<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\CorsoDiLaurea;
use Model\Insegnamento;
use Model\Materiale;

class PersistentManager {

    private static ?PersistentManager $instance = null;
    private EntityManagerInterface $em;

    // Costruttore privato (Singleton)
    private function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    // Ottieni l'istanza unica
    public static function getInstance(): self {
        if (self::$instance === null) {
            $em = require __DIR__ . '/doctrine-bootstrap.php';
            self::$instance = new self($em);
        }
        return self::$instance;
    }

    // CRUD base
    public function save(object $entity): void {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function update(): void {
        $this->em->flush();
    }

    public function delete(object $entity): void {
        $this->em->remove($entity);
        $this->em->flush();
    }

    public function find(string $class, int $id): ?object {
        return $this->em->find($class, $id);
    }

    public function findAll(string $class): array {
        return $this->em->getRepository($class)->findAll();
    }

    public function findBy(string $class, array $criteria): array {
        return $this->em->getRepository($class)->findBy($criteria);
    }

    public function findOneBy(string $class, array $criteria): ?object {
        return $this->em->getRepository($class)->findOneBy($criteria);
    }








    // Query custom


    public function CercaInsegnamento(string $Nome_Insegnamento): Insegnamento {
        $Insegnamento = $this->em->getRepository(Insegnamento::class)->findOneBy(['nomeInsegnamento' => $Nome_Insegnamento]);
        return $Insegnamento;
    }

    public function CercaCorsoDiLaurea(string $Nome_Corso): CorsoDiLaurea {
        $corso = $this->em->getRepository(CorsoDiLaurea::class)->findOneBy(['nomeCorso' => $Nome_Corso]);
        return $corso;
    }



    
    /**
     * Cerca materiali per titolo.
     * @param string $titolo Il titolo del materiale da cercare.
     * @return array Un array di materiali che corrispondono al termine di ricerca.
     */
   public function cercaMaterialePerTitolo(string $titolo): array {
    $qb = $this->em->createQueryBuilder();
    $qb->select('m', 'i', 'c')
        ->from(\Model\Materiale::class, 'm')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->where('m.titolo LIKE :titolo')
        ->setParameter('titolo', "%$titolo%");
    return $qb->getQuery()->getArrayResult();
}






/**
 * Filtra i materiali per titolo, insegnamento, tipologia, corso di laurea e tag.
 * 
 * @param string $titolo Il titolo del materiale da cercare.
 * @param string $insegnamento Il nome dell'insegnamento da cercare.
 * @param string $tipologia La tipologia del materiale da cercare.
 * @param string $corso Il corso di laurea del materiale da cercare.
 * @param string $tag Il tag del materiale da cercare.
 * @return array Un array di materiali che corrispondono ai criteri di ricerca.
 */
public function FiltraMateriale(
    string $titolo,
    string $insegnamento,
    string $tipologia,   // "appunto", "esame" oppure ""
    string $corso,
    string $tag
) {
    $risultati = [];

    // -------------------------------------------------
    // 1) SOLO APPUNTI
    // -------------------------------------------------
    if ($tipologia === "appunto") {

        $qb = $this->em->createQueryBuilder();

        $qb->select('a', 'i', 'c')
            ->from(\Model\Appunto::class, 'a')
            ->join('a.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->where('a.titolo LIKE :titolo')
            ->andWhere('i.nomeInsegnamento LIKE :insegnamento')
            ->andWhere('c.nomeCorso LIKE :corso')
            ->setParameter('titolo', "%$titolo%")
            ->setParameter('insegnamento', "%$insegnamento%")
            ->setParameter('corso', "%$corso%");

        // filtro tag SOLO per Appunti
        if (!empty($tag)) {
            $qb->andWhere('a.tag LIKE :tag')
               ->setParameter('tag', "%$tag%");
        }

        return $qb->getQuery()->getResult();
    }

    //ricerca solo in esame e non in appunto
    if ($tipologia === "esame") {

        $qb = $this->em->createQueryBuilder();

        $qb->select('e', 'i', 'c')
            ->from(\Model\Esame::class, 'e')
            ->join('e.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->where('e.titolo LIKE :titolo')
            ->andWhere('i.nomeInsegnamento LIKE :insegnamento')
            ->andWhere('c.nomeCorso LIKE :corso')
            ->setParameter('titolo', "%$titolo%")
            ->setParameter('insegnamento', "%$insegnamento%")
            ->setParameter('corso', "%$corso%");

        // niente tag per Esami

        return $qb->getQuery()->getResult();
    }

    // -------------------------------------------------
    // 3) STRINGA VUOTA → CERCA IN ENTRAMBI
    // -------------------------------------------------

    // APPUNTI
    $qbA = $this->em->createQueryBuilder();
    $qbA->select('a', 'i', 'c')
        ->from(\Model\Appunto::class, 'a')
        ->join('a.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->where('a.titolo LIKE :titolo')
        ->andWhere('i.nomeInsegnamento LIKE :insegnamento')
        ->andWhere('c.nomeCorso LIKE :corso')
        ->setParameter('titolo', "%$titolo%")
        ->setParameter('insegnamento', "%$insegnamento%")
        ->setParameter('corso', "%$corso%");

    if (!empty($tag)) {
        $qbA->andWhere('a.tag LIKE :tag')
            ->setParameter('tag', "%$tag%");
    }

    $risultati = array_merge($risultati, $qbA->getQuery()->getResult());

    // ESAMI
    $qbE = $this->em->createQueryBuilder();
    $qbE->select('e', 'i', 'c')
        ->from(\Model\Esame::class, 'e')
        ->join('e.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->where('e.titolo LIKE :titolo')
        ->andWhere('i.nomeInsegnamento LIKE :insegnamento')
        ->andWhere('c.nomeCorso LIKE :corso')
        ->setParameter('titolo', "%$titolo%")
        ->setParameter('insegnamento', "%$insegnamento%")
        ->setParameter('corso', "%$corso%");

    $risultati = array_merge($risultati, $qbE->getQuery()->getResult());

    return $risultati;
    }

}