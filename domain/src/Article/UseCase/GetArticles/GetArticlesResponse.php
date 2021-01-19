<?php

namespace Domain\Article\UseCase\GetArticles;

use Domain\Article\Entity\Article;

class GetArticlesResponse
{
    /**
     * @param array<int, Article> $articles
     */
    public function __construct(
        public array $articles
    ) { }
}
