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
     * @return array Un array di materiali che corrispondono al termine di ricerca, ritorna ogetti materiale, studente, insegnamento, corso + i download per ognuno.
     */
   public function cercaMaterialePerTitolo(string $titolo): array {
    $qb = $this->em->createQueryBuilder();
    $qb->select('m.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file_MymeTypeFile as tipoFile', 
        'm.file_contenutoFile as contenutofile',
     'i.nomeInsegnamento as insegnamento',
      'c.nomeCorso as corso',
      's.nome as studente',
      'count(d.id) as numeroDownload',
      'Average(m.valutazione) as mediaValutazione',
      )
        ->from(\Model\Materiale::class, 'm')
        ->leftjoin('m.downloads', 'd')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->join('m.recensioni', 'r')
        ->where('m.titolo LIKE :titolo')
        ->setParameter('titolo', "%$titolo%")
        ->groupBy('m.id');


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
 * @return array Un array di materiali che corrispondono ai criteri di ricerca, ritorna ogetti materiale, studente, insegnamento, corso + i download per ognuno.
 */
public function FiltraMateriale(    
    ?string $titolo,
    ?string $insegnamento,
    ?string $tipologia,   // "appunto", "esame" oppure ""
    ?string $corso,
    ?string $tag
 ): array {



   $qb = $this->em->createQueryBuilder();

   // Indipendentemente da esame o appunto la parte di query è la stessa
   $qb->select('m.id as idMateriale',
    'm.titolo as titoloMateriale',
        'm.file_MymeTypeFile as tipoFile', 
        'm.file_contenutoFile as contenutofile',
     'i.nomeInsegnamento as insegnamento',
      'c.nomeCorso as corso',
      's.nome as studente',
      'count(d.id) as numeroDownload',
      'Average(m.valutazione) as mediaValutazione',
      )
        ->from(\Model\Materiale::class, 'm')
        ->leftjoin('m.downloads', 'd')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c');


    // Se il titolo non è vuoto, aggiungi una condizione di ricerca per il titolo
    if (!empty($titolo)) {
        $qb->where('m.titolo LIKE :titolo')
        ->setParameter('titolo', "%$titolo%");
    }

    // Se l'insegnamento non è vuoto, aggiungi una condizione di ricerca per l'insegnamento
    if (!empty($insegnamento)) {
        $qb->andWhere('i.nomeInsegnamento = :insegnamento')
        ->setParameter('insegnamento', $insegnamento);
    }


    // Se la tipologia non è vuota, aggiungi una condizione di ricerca per la tipologia
    if (!empty($tipologia)) {
        $qb->andWhere('m.tipologia = :tipologia')
        ->setParameter('tipologia', $tipologia);
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


    // Calcola il totale dei download per ogni materiale
    $qb->expr()->count('m.downloads');


    // Esegui la query, e ottieni i risultati come un array
    return$qb->getQuery()->getArrayResult();
    
    }


    
    /**
     * Ordina i materiali in base al criterio scelto dall'utente.
     * @param string $criterio Il criterio di ordinamento.
     * @return array Un array di materiali ordinati.
     */
    public function getMaterialeOrdinato(string $criterio): array {


        $qb = $this->em->createQueryBuilder();



        $qb->select('m.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file_MymeTypeFile as tipoFile', 
        'm.file_contenutoFile as contenutofile',
     'i.nomeInsegnamento as insegnamento',
      'c.nomeCorso as corso',
      's.nome as studente',
      'count(d.id) as numeroDownload',
      'Average(m.valutazione) as mediaValutazione',
      )

        ->from(\Model\Materiale::class, 'm')
        ->leftjoin('m.downloads', 'd')
        ->join('m.studente', 's')
        ->join('m.insegnamento', 'i')
        ->join('i.corsoDiLaurea', 'c')
        ->join('m.recensioni', 'r')
        ->groupBy('m.id');

        if (strtolower($criterio) === 'download') {
            $qb->orderBy('m.numeroDownload', 'DESC');
        } elseif (strtolower($criterio) === 'valutazione') {
            $qb->orderBy('m.mediaValutazione', 'DESC');
        }
    return $qb->getQuery()->getArrayResult();
    }




    /**
     * Trova preferito per studente e materiale.
     * @param int $id_materiale L'ID del materiale.
     * @param int $id_studente L'ID dello studente.
     * @return array Un array di preferiti, altrimenti null.
     */
    public function trovaPreferitiPerUtenteEMateriale(int $id_materiale, int $id_studente): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select('m.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file_MymeTypeFile as tipoFile', 
        'm.file_contenutoFile as contenutofile')
            ->join('p.materiale', 'm')
            ->from(\Model\Preferito::class, 'p')
            ->where('p.materiale = :id_materiale')
            ->andWhere('p.studente = :id_studente')
            ->setParameter('id_materiale', $id_materiale)
            ->setParameter('id_studente', $id_studente);
            
        return $qb->getQuery()->getarrayResult();
    }


    
}
