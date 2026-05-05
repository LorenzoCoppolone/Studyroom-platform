<?php
namespace Foundation\Persistent;
use doctrine\ORM\EntityManagerInterface;
use Dom\Entity;

class PersistentManager {

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }


    public function CercaMaterialePerTitolo(String $Titolo) {
        // Logica per cercare i materiali nel database
        $qb = $this->em->createQueryBuilder();
        $qb->select('m.Id, m.Titolo, m.Insegnamento, m.Tipologia, m.CorsoDiLaurea, m.Tag, m.File')
            ->from(Entity::class, 'Materiale', 'm')
            ->join('m', 'Insegnamento', 'I', 'WITH', 'm.insegnamento_codice = I.CodiceInsegnamento')
            ->join('I', 'CorsoDiLaurea', 'C', 'WITH', 'I.corsoDiLaurea_codice = C.codiceCorso')
            ->where($qb->expr()->like('m.Titolo', ':Titolo'))
            ->setParameter('Titolo', $Titolo);
        $query = $qb->getQuery();
        $materiali = $query->getArrayResult();    
        return $materiali;
    }
   
}