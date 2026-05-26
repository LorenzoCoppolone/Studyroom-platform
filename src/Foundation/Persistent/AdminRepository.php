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
    'm.file.mimeType as mimeTypeFile',
    'm.file.contenuto as contenutoFile',
    's.nome as nomeStudente',
    's.cognome as cognomeStudente',
    's.username as usernameStudente',
    's.email as emailStudente',
    's.id as idStudente',
    )
        ->from(Materiale::class, 'm')
        ->join('m.studente', 's')
        ->Where('m.idMateriale = :id_materiale')
        ->setParameter('id_materiale', $id_materiale);
    $result = $qb->getQuery()->getArrayResult();
    return $result;
    }


    public function eliminaSegnalazioni(int $id_materiale){
        $qb = $this->em->createQueryBuilder();
        $qb->delete(Segnalazione::class, 'se')
        ->where('se.materialeSegnalato = :id_materiale')
        ->setParameter('id_materiale', $id_materiale);
        $qb->getQuery()->execute();
    }
}