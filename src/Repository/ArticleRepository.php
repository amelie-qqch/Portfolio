<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param Article $article
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Article $article)
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush($article);
    }

    /**
     * @param Article $article
     * @throws \Doctrine\Common\Persistence\Mapping\MappingException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Article $article)
    {
        $this->getEntityManager()->remove($article);
        $this->getEntityManager()->flush($article);
    }

    //ça fait pareil que create ça sert surement à rien du coup :(
    public function update(Article $article)
    {
        $this->getEntityManager()->flush($article);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Article[]
     */
    public function findLatest():array
    {
        return $this->createQueryBuilder('article')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }
}
