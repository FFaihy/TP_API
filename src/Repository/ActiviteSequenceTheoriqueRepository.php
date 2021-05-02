<?php

namespace App\Repository;

use App\Entity\ActiviteSequenceTheorique;
use App\Entity\Sequencetheorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteSequenceTheorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteSequenceTheorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteSequenceTheorique[]    findAll()
 * @method ActiviteSequenceTheorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteSequenceTheoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteSequenceTheorique::class);
    }

    /**
     * @return ActiviteSequenceTheorique[]
     */
    public function findAllBySequencetheorique(Sequencetheorique $st)
    {
        return $this->createQueryBuilder('ActiviteSequenceTheorique')
            ->andWhere('ActiviteSequenceTheorique.idsequencetheorique_id = :idsequencetheorique')
            ->setParameter('idsequencetheorique', $st->getId())
            ->orderBy('ActiviteSequenceTheorique.ordre', 'ASC')
//            ->leftJoin('genus.genusScientists', 'genusScientist')
//            ->addSelect('genusScientist')
            ->getQuery()
            ->execute();
    }
}