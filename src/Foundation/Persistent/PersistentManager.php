<?php
namespace Foundation\Persistent;
use Doctrine\ORM\EntityManagerInterface;
use Model\Materiale;
use Model\Preferito;
use Model\Download;
use Model\Recensione;
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

    /**
     * Questa funzione salva un oggetto nel DB
     * @param entity Oggetto da salvare nel DB
     * @return void 
     * persist() -> registra l'entità nell'EntityManager
     * flush()   -> sincronizza le modifiche con il database
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
     * remove() -> marca l'entità per l'eliminazione
     * flush()  -> esegue il DELETE nel database
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
    public function findAll(string $class): array {
        return $this->em->getRepository($class)->findAll();
    }

    /**
     * Trova le entità secondo determinati criteri
     * @param class La classe in cui cercare 
     * @param criteria Lista di criteri 
     * @return array Restituisce un array di oggetti
     */
    public function findBy(string $class, array $criteria): array {
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

    // Permette di creare query in più passi
    $qb = $this->em->createQueryBuilder();

    // Aggiungi le colonne da ritornare, le nomino in maniera significativa, 
    // così che nella UI possa essere facilmente identificata la colonna corrispondente
    $qb->select(
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        's.username as nome_studente',
        'COUNT(d.id) as numeroDownload',
        'COUNT(r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione',
    )

    // Aggiungi la colonna tipologia, 
    // nella quale verrà scritto "APPUNTO" se il materiale è un appunto e "ESAME" se è un esame
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
        $qb->where('m.titolo LIKE :titolo')
           ->setParameter('titolo', "%$titolo%");
        }else{
            throw new \Exception("Il titolo non può essere vuoto");
        }

    // Se l'insegnamento non è vuoto, aggiungi una condizione di ricerca per l'insegnamento
    if (!empty($insegnamento)) {
        $qb->andWhere('i.nomeInsegnamento = :insegnamento')
        ->setParameter('insegnamento', $insegnamento);
    }

    // Se la tipologia non è vuota, aggiungi una condizione di ricerca per la tipologia
    if (strtolower($tipologia) === "appunto") {
        $qb->andWhere('m INSTANCE OF Model\Appunto');
    } elseif (strtolower($tipologia) === "esame") {
        $qb->andWhere('m INSTANCE OF Model\Esame');
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

    // raggruppa per id materiale
    $qb->groupBy('m.id');

     // controllo per il criterio, in base alla scelta si ordineranno i materiali
    if (!empty($criterio) && strtolower($criterio) === 'download') {
        $qb->orderBy('numeroDownload', 'DESC');
    } elseif (!empty($criterio) && strtolower($criterio) === 'valutazione') {
        $qb->orderBy('mediaValutazione', 'DESC');
    }

    //Restituisci i primi limit materiali
    $qb->setFirstResult($offset)
       ->setMaxResults($limit);

    // Esegui la query, e ottieni i risultati come un array
    $result = $qb->getQuery()->getArrayResult();

    // ciclo per ottenere il binario del file e lo codifico in base 64
    foreach ($result as &$row) {
        if (is_resource($row['contenutoFile'])) {
            $binario = stream_get_contents($row['contenutoFile']); // BISOGNEREBBE PENSARE AD UNA SOLUZIONE CON JS,
            $row['contenutoFile'] = base64_encode($binario);     // IN MODO CHE VENGA RESTITUITA SOLO LA PRIMA PAGINA DEL FILE
        }   //PROBABILMENTE NON SI SELEZIONA IL FILE NELLA QUERY MA SE LO PRENDE DIRETTAMENTE JS TRAMITE L'ID
    }     //STESSA COSA PER TUTTI I METODI CHE IMPLEMENTANO QUESTO FOR.

    // Restituisci i risultati, il contenuto del file è binario codificato in base 64
    return $result;
    
    }

    /**
     * Trova preferito per studente e materiale.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di preferiti, altrimenti null.
     */
    public function trovaPreferitiPerUtente(int $id_studente, int $offset, int $limit): array {
        
        // Creo una query Doctrine dinamica
        $qb = $this->em->createQueryBuilder();
        
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile', // Il contenuto è BLOB
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        'COUNT(d.id) as numeroDownload',
        'COUNT(r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione'
        )
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

        foreach ($result as &$row) {
            // Verifico se il valore è uno stream PHP
            if (is_resource($row['contenutoFile'])) {
                // Converte lo stream in stringa binaria
                $binario = stream_get_contents($row['contenutoFile']);
                // Conversione base64
                $row['contenutoFile'] = base64_encode($binario);
            }
        }
        return $result;
    }


 //DA TESTARE
    /**
     * Trova download per studente.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di download.
     */
    public function trovaDownloadPerUtente(
        int $id_studente, 
        int $offset, 
        int $limit
        ): array {

        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'i.nomeInsegnamento as insegnamento',
        'c.nomeCorso as corso_di_Laurea',
        'COUNT(DISTINCT d.id) as numeroDownload',
        'COUNT(DISTINCT r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione'
        )

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

        foreach ($result as &$row) {
            if (is_resource($row['contenutoFile'])) {
                $binario = stream_get_contents($row['contenutoFile']);
                $row['contenutoFile'] = base64_encode($binario);
            }
        }
        return $result;
    }

 //DA TESTARE
    /**
     * Trova recensioni per studente e materiale.
     * @param int $id_studente L'ID dello studente.
     * @return array Un array di recensioni.
     */
    public function trovaRecensioniPerUtente(int $id_studente, int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'r.voto as votoRecensione',
        'r.commento as commentoRecensione',
        )
            ->from(Recensione::class, 'r')
            ->join('r.materiale', 'm')
            ->Where('r.studente_id = :id_studente')
            ->setParameter('id_studente', $id_studente);

            $qb->setFirstResult($offset)
               ->setMaxResults($limit);

        $result =$qb->getQuery()->getArrayResult();

        foreach ($result as &$row) {
            if (is_resource($row['contenutoFile'])) {
                $binario = stream_get_contents($row['contenutoFile']);
                $row['contenutoFile'] = base64_encode($binario);
            }
        }

        return $result;
    }

  //DA TESTARE
    /**
     * Materiali popolari per utente.
     * @param int $id_studente L'ID dello studente.
     * @param int $offset L'offset per la paginazione.
     * @param int $limit Il limite per la paginazione.
     * @return array Un array di materiali.
     */
    public function MaterialiPopolariUtente(int $id_studente, int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'COUNT(d.id) as numeroDownload',
        'COUNT(r.id) as numeroRecensioni',
        'AVG(r.voto) as mediaValutazione'
        )
            ->from(Download::class, 'd')
            ->join('d.materiale', 'm')
            ->where('d.studente_id = :id_studente')
            ->setParameter('id_studente', $id_studente);

            $qb->groupBy('m.id');

            $qb->setFirstResult($offset)
               ->setMaxResults($limit);

        $result = $qb->getQuery()->getArrayResult();

        foreach ($result as &$row) {
            if (is_resource($row['contenutoFile'])) {
                $binario = stream_get_contents($row['contenutoFile']);
                $row['contenutoFile'] = base64_encode($binario);
            }
        }

        return $result;
    }


    public function trovaMaterialiSegnalati(int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.studente_id as idStudente',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        'COUNT(se.id) as numeroSegnalazioni',
        
        )
            ->from(Segnalazione::class, 'se')
            ->join('se.materiale', 'm')
            ->groupBy('m.id')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

            //ciclo per ottenere il file in base 64, (quello usato nelle altre query) o metodo migliore se lo troviamo 


        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }

    
    public function trovaUtenteSegnalato(int $id_materiale, int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        's.id as idUtente',
        's.username as usernameUtente',
        's.nome as nomeUtente',
        's.cognome as cognomeUtente',
        )
            ->from(Materiale::class, 'm')
            ->join('s.studente', 'm')


            // si può fare cosi perchè l'id del materiale che uso viene
            // dalla query trovaMaterialiSegnalati, dunque è sicuramente un materiale segnalato
            // e quindi i dati sono dello studente segnalato in quanto possessore del materiale.
            ->Where('m.studente_id = :id_studente')

            ->setParameter('id_studente', $id_studente); 
            $qb->setFirstResult($offset)
               ->setMaxResults($limit);

        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }


    public function trovaMaterialiSegnalatiPerUtente(int $id_studente, int $offset, int $limit): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select( 
        'm.id as idMateriale',
        'm.titolo as titoloMateriale',
        'm.file.MimeTypeFile AS tipoFile',
        'm.file.contenutoFile AS contenutoFile',
        )
            ->from(Segnalazione::class, 'se')
            ->join('se.studente', 's')
            ->join('se.materiale', 'm')
            ->Where('se.studente_id = :id_studente')
            ->setParameter('id_studente', $id_studente)
            ->groupBy('m.id')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }
}