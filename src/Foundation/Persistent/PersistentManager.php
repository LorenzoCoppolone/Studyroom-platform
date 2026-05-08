<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\CorsoDiLaurea;
use Model\Insegnamento;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
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
  public function cercaMaterialePerTitolo(string $titolo, int $offset, int $limit): array {
    $qb = $this->em->createQueryBuilder();
    $qb->select(
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        's.nome as nome_studente',
        'COUNT(d.id) as numeroDownload',
        'AVG(r.voto) as mediaValutazione',
      )
        ->from(\Model\Materiale::class, 'm')
        ->leftjoin('m.downloads', 'd')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->leftjoin('m.recensioni', 'r')
        ->where('m.titolo LIKE :titolo')
        ->setParameter('titolo', "%$titolo%")
        ->groupBy('m.id')
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        $risultati = $qb->getQuery()->getArrayResult();

foreach ($risultati as &$row) {
    if (is_resource($row['contenutoFile'])) {
        $binario = stream_get_contents($row['contenutoFile']);
        $row['contenutoFile'] = base64_encode($binario);
    }
}

    return $risultati;
}






/**
 * Filtra i materiali per titolo, insegnamento, tipologia, corso di laurea e tag.
 * 
 * @param string $titolo Il titolo del materiale da cercare.
 * @param string $insegnamento Il nome dell'insegnamento da cercare.
 * @param string $tipologia La tipologia del materiale da cercare.
 * @param string $corso Il corso di laurea del materiale da cercare.
 * @param string $tag Il tag del materiale da cercare.
 * @return array Un array di materiali che corrispondono ai criteri di ricerca, ritorna ogetti materiale, studente, insegnamento, corso + i download per ognuno.
 */
public function FiltraEOrdinaMateriale(    
    string $titolo,
    ?string $insegnamento,
    ?string $tipologia,   // "appunto", "esame"
    ?string $corso,
    ?string $tag,
    ?string $criterio,
    int $offset,
    int $limit
 ): array {



   $qb = $this->em->createQueryBuilder();

   // Indipendentemente da esame o appunto la parte di query è la stessa
   $qb->select(
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        's.nome as nome_studente',
        'COUNT(d.id) as numeroDownload',
        'AVG(r.voto) as mediaValutazione',
      )
        ->from(Materiale::class, 'm')
        ->leftjoin('m.downloads', 'd')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->leftjoin('m.recensioni', 'r');
        $qb->where('m.titolo LIKE :titolo')
        ->setParameter('titolo', "%$titolo%");
    


    // Se l'insegnamento non è vuoto, aggiungi una condizione di ricerca per l'insegnamento
    if (!empty($insegnamento)) {
        $qb->andWhere('i.nomeInsegnamento = :insegnamento')
        ->setParameter('insegnamento', $insegnamento);
    }


    // Se la tipologia non è vuota, aggiungi una condizione di ricerca per la tipologia
    if (strtolower($tipologia) === "appunto") {
        $qb->andWhere('m INSTANCE OF Model\Appunto')
           ->addselect('m', "'APPUNTO' AS tipologia");
    } elseif (strtolower($tipologia) === "esame") {
        $qb->andWhere('m INSTANCE OF Model\Esame')
           ->addselect('m', "'ESAME' AS tipologia");
    }
      


    // Se il corso di laurea non è vuoto, aggiungi una condizione di ricerca per il corso di laurea
    if (!empty($corso)) {
        $qb->andWhere('c.nomeCorso = :corso')
        ->setParameter('corso', $corso);
    }


    // Se il tag non è vuoto, aggiungi una condizione di ricerca per il tag
    if (!empty($tag)) {
        $qb->andWhere('m.tag = :tag')
        ->setParameter('tag', $tag);
    }

    $qb->groupBy('m.id');

     // controllo per il criterio, in base alla scelta si ordineranno i materiali
    if (!empty($criterio) && strtolower($criterio) === 'download') {
        $qb->orderBy('numeroDownload', 'DESC');
    } elseif (!empty($criterio) && strtolower($criterio) === 'valutazione') {
        $qb->orderBy('mediaValutazione', 'DESC');
    }


    //raggruppa per id materiale e restituisci i primi limit materiali
    $qb->setFirstResult($offset)
       ->setMaxResults($limit);




    // Esegui la query, e ottieni i risultati come un array
    $result = $qb->getQuery()->getArrayResult();



    // ciclo per ottenere il binario del file e lo codifico in base 64
    foreach ($result as &$row) {
        if (is_resource($row['contenutoFile'])) {
            $binario = stream_get_contents($row['contenutoFile']);
            $row['contenutoFile'] = base64_encode($binario);
        }
    }

    // Restituisci i risultati, il contenuto del file è binario codificato in base 64
    return $result;
    
    }







    /**
     * Trova preferito per studente e materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param int $id_studente L'ID dello studente.
     * @return array Un array di preferiti, altrimenti null.
     */
    public function trovaPreferitiPerUtente(int $id_materiale, int $id_studente): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select('m.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.File as File_Materiale',
        )
            ->from(Preferito::class, 'p')
            ->join('p.materiale', 'm')
            ->where('m.id = :id_materiale')
            ->andWhere('p.studente_id = :id_studente')
            ->setParameter('id_materiale', $id_materiale)
            ->setParameter('id_studente', $id_studente);
            
        return $qb->getQuery()->getarrayResult();
    }


    public function trovaDownloadPerUtente(int $id_materiale, int $id_studente): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select(
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.File as File_Materiale',
        )
            ->from(Download::class, 'd')
            ->join('d.materiale', 'm')
            ->where('m.id = :id_materiale')
            ->andWhere('d.studente_id = :id_studente')
            ->setParameter('id_materiale', $id_materiale)
            ->setParameter('id_studente', $id_studente);
            
        return $qb->getQuery()->getarrayResult();
    }



}