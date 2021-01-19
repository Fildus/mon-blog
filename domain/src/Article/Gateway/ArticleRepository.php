<?php


namespace Domain\Article\Gateway;


use Domain\Article\Entity\Article;

interface ArticleRepository
{
    public function createArticle(Article $article): void;

    /**
     * @return array<Article>
     */
    public function getArticles(): array;
}