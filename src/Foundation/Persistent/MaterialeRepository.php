<?php
namespace Foundation\Persistent;

use Doctrine\ORM\EntityManagerInterface;
use Model\Materiale;
use Model\Studente;
use Model\Preferito;
use Model\Download;
use Model\Recensione;

class MaterialeRepository {
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * cerca i materiali per titolo, insegnamento, tipologia, corso di laurea, tag e un eventuale criterio di ordinamento.
    * 
    * @param string $titolo Il titolo del materiale da cercare.
    * @param string $insegnamento Il nome dell'insegnamento da cercare.
     * @param string $tipologia La tipologia del materiale da cercare.
     * @param string $corso Il corso di laurea del materiale da cercare.
     * @param string $tag Il tag del materiale da cercare.
     * @param string $criterio Il criterio di ricerca da applicare.
     * @param int $offset L'offset da utilizzare per la paginazione.
     * @param int $limit Il limite di materiali da ritornare.
     * @throws Exception Se il titolo è vuoto.
     * @return array Un array di materiali che corrispondono ai criteri di ricerca, ritorna ogetti materiale, studente, insegnamento, corso + i download per ognuno.
     */
    public function cerca(    
        string $titolo,
        int $offset,
        int $limit,
        ?string $insegnamento = "",
        ?string $tipologia = "",   // "appunto", "esame"
        ?string $corso = "",
        ?string $tag = "",
        ?string $criterio = "",
    ): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select(
            'm.id as idMateriale',
            'm.titolo as titoloMateriale',
            'i.nomeInsegnamento as insegnamento',
            'c.nomeCorso as corso_di_Laurea',
            's.username as nome_studente',
            'COUNT(DISTINCT d.id) as numeroDownload',
            'COUNT(DISTINCT r.id) as numeroRecensioni',
            'AVG(r.voto) as mediaValutazione',
        )
            ->addSelect(
        "CASE
            WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
            WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
            ELSE 'ALTRO'
        END AS tipologia"
        )
            ->from(Materiale::class, 'm')
            ->leftjoin('m.downloads', 'd')
            ->join('m.studente', 's')
            ->join('m.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->leftjoin('m.recensioni', 'r');
        if(!empty($titolo)){
            $qb->where('m.titolo LIKE :titolo')->setParameter('titolo', "%$titolo%");
        }
        if (!empty($insegnamento)) {
            $qb->andWhere('i.nomeInsegnamento = :insegnamento')->setParameter('insegnamento', $insegnamento);
        }
        if (strtolower($tipologia) === "appunto") {
            $qb->andWhere('m INSTANCE OF Model\Appunto');
        }elseif (strtolower($tipologia) === "esame") {
            $qb->andWhere('m INSTANCE OF Model\Esame');
        }
        if (!empty($corso)) {
            $qb->andWhere('c.nomeCorso = :corso')->setParameter('corso', $corso);
        }
        $qb->groupBy('m.id');
        if (!empty($criterio) && strtolower($criterio) === 'download') {
            $qb->orderBy('numeroDownload', 'DESC');
        } elseif (!empty($criterio) && strtolower($criterio) === 'valutazione') {
            $qb->orderBy('mediaValutazione', 'DESC');
        }
        $qb->setFirstResult($offset)
        ->setMaxResults($limit);
        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }

    public function dettagliMateriale(
        int $idMateriale
    ): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select(
            'm.id as idMateriale',
            'm.titolo as titoloMateriale',
            'i.nomeInsegnamento as insegnamento',
            'c.nomeCorso as corso_di_Laurea',
            's.username as nome_studente',
            'COUNT(DISTINCT d.id) as numeroDownload',
            'COUNT(DISTINCT r.id) as numeroRecensioni',
            'AVG(r.voto) as mediaValutazione',
            'm.file.contenutoFile as contenutoFile',
            'm.file.mimeTypeFile as mimeTypeFile',
            'm.file.dimensioneFile as dimensioneFile'
        )
            ->addSelect(
        "CASE
            WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
            WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
            ELSE 'ALTRO'
        END AS tipologia"
        )
            ->from(Materiale::class, 'm')
            ->leftjoin('m.downloads', 'd')
            ->join('m.studente', 's')
            ->join('m.insegnamento', 'i')
            ->join('i.corsoDiLaurea', 'c')
            ->leftjoin('m.recensioni', 'r')
            ->where('m.id = :idMateriale')
            ->setParameter('idMateriale', $idMateriale);
        $result = $qb->getQuery()->getOneOrNullResult();
        return $result;
    }

    /**
     * Trova tutte le recensioni di un singolo materiale, con l'username di chi le ha scritte.
     *
     * @param int $idMateriale ID del materiale.
     * @param int $offset Offset per la paginazione.
     * @param int $limit Limite per la paginazione.
     * @return array Recensioni del materiale (username, voto, commento).
     */
    public function trovaRecensioniMateriale(int $idMateriale, int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select(
            's.username as nomeStudente',
            'r.voto as votoRecensione',
            'r.commento as commentoRecensione'
        )
            ->from(Recensione::class, 'r')
            ->join('r.studente', 's')
            ->where('r.materiale = :idMateriale')
            ->setParameter('idMateriale', $idMateriale)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return $qb->getQuery()->getArrayResult();
    }


    public function trovaMaterialiPopolari(int $offset = 0, int $limit = 10): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select(
            'm.id AS idMateriale',
            'm.titolo AS titoloMateriale',
            'i.nomeInsegnamento AS insegnamento',
            'c.nomeCorso AS corso_di_Laurea',
            's.username AS nome_studente',
            'COUNT(DISTINCT d.id) AS numeroDownload',
            'COUNT(DISTINCT r.id) AS numeroRecensioni',
            'AVG(r.voto) AS mediaValutazione',
        )
        ->addSelect("
            CASE
                WHEN m INSTANCE OF Model\\Appunto THEN 'APPUNTO'
                WHEN m INSTANCE OF Model\\Esame THEN 'ESAME'
                ELSE 'ALTRO'
            END AS tipologia
        ")
        ->from(Materiale::class, 'm')
        ->leftJoin('m.downloads', 'd')
        ->leftJoin('m.recensioni', 'r')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->groupBy('m.id')
        ->OrderBy('mediaValutazione', 'DESC')
        ->addOrderBy('numeroRecensioni', 'DESC')
        ->addOrderBy('numeroDownload', 'DESC')
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        return $qb->getQuery()->getArrayResult();
    }



}