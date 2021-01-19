<?php

namespace App\Infrastructure\Adapter\Repository;

use App\Infrastructure\Doctrine\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository implements \Domain\Article\Gateway\ArticleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function createArticle(\Domain\Article\Entity\Article $article): void
    {
        $doctrineArticle = new Article();
        $doctrineArticle
            ->setUuid($article->uuid)
            ->setTitle($article->title)
            ->setContent($article->content);

        $this->getEntityManager()->persist($doctrineArticle);
        $this->getEntityManager()->flush();
    }
}
