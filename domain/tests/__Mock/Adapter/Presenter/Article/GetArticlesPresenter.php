<?php

namespace Domain\Tests\__Mock\Adapter\Presenter\Article;

use Domain\Article\UseCase\GetArticles\GetArticlesResponse;

class GetArticlesPresenter implements \Domain\Article\UseCase\GetArticles\GetArticlesPresenter
{
    public GetArticlesResponse $response;

    public function present(GetArticlesResponse $response): void
    {
        $this->response = $response;
    }
}