<?php


namespace Domain\Tests\__Mock\Adapter\Repository;


use Domain\Article\Entity\Article;

class ArticleRepository implements \Domain\Article\Gateway\ArticleRepository
{
    /**
     * @var Article[]
     */
    public array $articles = [];

    public function createArticle(Article $article): void
    {
        $this->articles[$article->uuid->toString()] = $article;
    }
}