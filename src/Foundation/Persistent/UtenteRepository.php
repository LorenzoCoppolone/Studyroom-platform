<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\Studente;
use Model\Preferito;
use Model\Materiale;
use Model\Download;
use Model\Recensione;

class UtenteRepository{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Trova preferito per studente e materiale.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di preferiti, altrimenti null.
     */
    public function trovaPreferiti(
        int $id_studente, 
        int $offset, 
        int $limit
        ): array {
        
        // Creo una query Doctrine dinamica
        $qb = $this->em->createQueryBuilder();
        
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        'COUNT(d.id) as numeroDownload',
        'COUNT(r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione'
        )
            ->addSelect("
            CASE WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
            WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
            ELSE 'ALTRO' END AS tipologia")
            ->from(Preferito::class, 'p')
            ->join('p.materiale', 'm')
            ->join('m.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->leftjoin('m.downloads', 'd')
            ->leftjoin('m.recensioni', 'r')
            ->Where('p.studente = :id_studente')
            ->setParameter('id_studente', $id_studente)
            ->groupBy('m.id')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        // Ritorna array PHP    
        $result = $qb->getQuery()->getArrayResult();

        return $result;
    }

    /**
     * Trova download per studente.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di download.
     */
    public function trovaDownload(
        int $id_studente, 
        int $offset, 
        int $limit
        ): array {

        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        'COUNT(DISTINCT d.id) as numeroDownload',
        'COUNT(DISTINCT r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione'
        )
            ->addSelect("
            CASE WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
            WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
            ELSE 'ALTRO' END AS tipologia")
            ->from(Download::class, 'p')
            ->join('p.materiale', 'm')
            ->join('m.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->leftjoin('m.downloads', 'd')
            ->leftjoin('m.recensioni', 'r')
            ->where('p.studente = :id_studente')
            ->setParameter('id_studente', $id_studente)
            ->groupBy('m.id')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }

    /**
     * Trova recensioni per studente e materiale.
     * @param int $id_studente L'ID dello studente.
     * @return array Un array di recensioni.
     */
    public function trovaRecensioni(
        int $id_studente, 
        int $offset, 
        int $limit
        ): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'r.voto as votoRecensione',
        'r.commento as commentoRecensione',
        )
            ->from(Recensione::class, 'r')
            ->join('r.materiale', 'm')
            ->where('r.studente = :id_studente')
            ->setParameter('id_studente', $id_studente);

            $qb->setFirstResult($offset)
               ->setMaxResults($limit);

        $result =$qb->getQuery()->getArrayResult();

        return $result;
    }

    /**
     * Materiali popolari per utente.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di materiali.
     */
    public function materialiPopolari(
        int $id_studente, 
        int $offset, 
        int $limit
    ): array {

        $qb = $this->em->createQueryBuilder();

        $qb->select(
            'm.id AS idMateriale',
            'm.titolo AS titoloMateriale',
            'i.nomeInsegnamento AS insegnamento',
            'c.nomeCorso AS corso_di_Laurea',
            's.username AS nome_studente',
            'COUNT(DISTINCT d.id) AS numeroDownload',
            'COUNT(DISTINCT r.id) AS numeroRecensioni',
            'AVG(r.voto) AS mediaValutazione'
        )
        ->addSelect("
            CASE
                WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
                WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
                ELSE 'ALTRO'
            END AS tipologia
        ")
        ->from(Materiale::class, 'm')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->leftJoin('m.downloads', 'd')
        ->leftJoin('m.recensioni', 'r')
        ->where('s.id = :id_studente')
        ->setParameter('id_studente', $id_studente)
        ->groupBy('m.id')
        ->orderBy('numeroDownload', 'DESC')
        ->addOrderBy('numeroRecensioni', 'DESC')
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        return $qb->getQuery()->getArrayResult();
    }


}