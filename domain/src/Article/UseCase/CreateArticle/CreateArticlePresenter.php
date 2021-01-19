<?php

namespace Domain\Article\UseCase\CreateArticle;

interface CreateArticlePresenter
{
    public function present(CreateArticleResponse $response): void;
}
