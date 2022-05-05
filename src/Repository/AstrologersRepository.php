<?php


namespace App\Repository;

use App\Entity\Astrologers;
use App\Entity\AstrologersServices;
use App\Entity\Services;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

/**
 * @method Astrologers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astrologers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astrologers[]    findAll()
 * @method Astrologers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstrologersRepository extends ServiceEntityRepository
{
    /**
     * AstrologersRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Astrologers::class);
    }

    public function findAllWithFilter(): array
    {
        return $this->createQueryBuilder('a')
            ->select(['a.name', 'a.image as photo', 'service.name as service_name'])
            ->leftJoin(
                AstrologersServices::class,
                'astrologer_services',
                Join::WITH,
                'astrologer_services.astrologer = a.id')
            ->leftJoin(Services::class,
                'service',
                Join::WITH,
                'astrologer_services.service = service.id')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findByIdWithFilter(int $id): array
    {
        return $this->createQueryBuilder('a')
            ->select(['a.bio', 'service.name as service_name, astrologer_services.price'])
            ->leftJoin(
                AstrologersServices::class,
                'astrologer_services',
                Join::WITH,
                'astrologer_services.astrologer = a.id')
            ->leftJoin(
                Services::class,
                'service',
                Join::WITH,
                'astrologer_services.service = service.id')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }

}