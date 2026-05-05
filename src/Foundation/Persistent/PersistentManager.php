<?php
namespace Foundation\Persistent;
use Dom\Entity;
use Doctrine\ORM\EntityManagerInterface;

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
    public function cercaMaterialePerTitolo(string $titolo): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select('m.Id, m.Titolo, m.Insegnamento, m.Tipologia, m.CorsoDiLaurea, m.Tag, m.File')
            ->from(Entity::class, 'Materiale', 'm')
            ->join('m', 'Insegnamento', 'I', 'WITH', 'm.insegnamento_codice = I.CodiceInsegnamento')
            ->join('I', 'CorsoDiLaurea', 'C', 'WITH', 'I.corsoDiLaurea_codice = C.codiceCorso')
            ->where($qb->expr()->like('m.Titolo', ':Titolo'))
            ->setParameter('Titolo', $titolo);
        return $qb->getQuery()->getArrayResult();
    }
}