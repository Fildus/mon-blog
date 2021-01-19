<?php

namespace Domain\Article\UseCase\CreateArticle;

use Domain\Article\Entity\Article;

class CreateArticleResponse
{
    public function __construct(
        public ?Article $entity
    ) { }
}
