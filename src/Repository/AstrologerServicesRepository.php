<?php


namespace App\Repository;

use App\Entity\AstrologersServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AstrologersServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method AstrologersServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method AstrologersServices[]    findAll()
 * @method AstrologersServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstrologerServicesRepository extends ServiceEntityRepository
{
    /**
     * AstrologerServicesRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AstrologersServices::class);
    }

}