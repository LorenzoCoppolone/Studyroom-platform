<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\Materiale;
use Model\Segnalazione;

class AdminRepository {
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    


  /**
     * Materiali segnalati che recupera l'admin
     * @param int $offset
     * @param int $limit
     * @return array lista di materiali segnalati
     */
    public function trovaSegnalazioni(
        int $offset, 
        int $limit
        ): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select(
    'm.id as idMateriale',
    'm.titolo as titoloMateriale',
    'COUNT(se.id) as numeroSegnalazioni',
)
    ->from(Segnalazione::class, 'se')
    ->Join('se.materialeSegnalato', 'm')
    ->groupBy('m.id')
    ->orderBy('numeroSegnalazioni', 'DESC')
    ->setFirstResult($offset)
    ->setMaxResults($limit);
        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }

    /**
     * Materiali segnalati che recupera l'admin
     * @param int $id_materiale
     * @return array Informazioni del materiale segnalato, restituito così in modo che la view sia semplificata
     */
    public function gestisciSegnalazioneMateriale(int $id_materiale): array {
    $qb = $this->em->createQueryBuilder();
    $qb->select(
    'm.id as idMateriale',
    'm.titolo as titoloMateriale',
    's.nome as nomeStudente',
    's.cognome as cognomeStudente',
    's.username as usernameStudente',
    's.email as emailStudente',
    's.id as idStudente',
    )
        ->from(Materiale::class, 'm')
        ->join('m.studente', 's')
        ->where('m.id = :id_materiale')
        ->setParameter('id_materiale', $id_materiale);
    $result = $qb->getQuery()->getArrayResult();
    return $result;
    }


    /**
     * Recupera il contenuto binario e il mimeType di un materiale via DBAL (senza hydration ORM).
     * Restituisce null se il materiale non esiste o non ha file.
     * @param int $id_materiale
     * @return array|null ['mimeType' => string, 'contenuto' => resource|string]
     */
    public function getFileMateriale(int $id_materiale): ?array {
        $conn = $this->em->getConnection();
        $row = $conn->executeQuery(
            'SELECT file_mimeTypeFile AS mimeType, file_contenutoFile AS contenuto FROM materiale WHERE id = ?',
            [$id_materiale]
        )->fetchAssociative();

        return ($row && $row['contenuto'] !== null) ? $row : null;
    }

    public function eliminaSegnalazioni(int $id_materiale){
        $qb = $this->em->createQueryBuilder();
        $qb->delete(Segnalazione::class, 'se')
        ->where('se.materialeSegnalato = :id_materiale')
        ->setParameter('id_materiale', $id_materiale);
        $qb->getQuery()->execute();
    }
}