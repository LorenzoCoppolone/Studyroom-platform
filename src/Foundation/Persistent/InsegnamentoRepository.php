<?php


namespace Foundation\Persistent;

use Doctrine\ORM\EntityManagerInterface;
use Model\Insegnamento;
use Model\CorsoDiLaurea;

class InsegnamentoRepository {
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

  public function trovaInsegnamenti(): array {
    $qb = $this->em->createQueryBuilder();

    $qb->select('
        i.id AS id,
        i.nomeInsegnamento AS nome,
        c.codiceCorso AS codiceCorso,
        c.nomeCorso AS nomeCorso
        ')
    ->from(Insegnamento::class, 'i')
    ->join('i.corsoDiLaurea', 'c');
    return $qb->getQuery()->getArrayResult();
}


    public function trovaCorsiDiLaurea(): array {
        $qb = $this->em->createQueryBuilder();
        $qb->select('
        c.codiceCorso as id,
        c.nomeCorso as nome
        '
        )
        ->from(CorsoDiLaurea::class, 'c');
        return $qb->getQuery()->getArrayResult();
    }
}