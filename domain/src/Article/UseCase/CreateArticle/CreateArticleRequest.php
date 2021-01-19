<?php

namespace Domain\Article\UseCase\CreateArticle;

class CreateArticleRequest
{
    public function __construct(
        public string $title,
        public string $content,
    ) {
//        throw new \Exception('You should add some testing rules');
    }
}
