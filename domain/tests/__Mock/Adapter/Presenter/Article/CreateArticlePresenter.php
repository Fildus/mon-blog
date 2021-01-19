<?php


namespace Domain\Tests\__Mock\Adapter\Presenter\Article;


use Domain\Article\UseCase\CreateArticle\CreateArticleResponse;

class CreateArticlePresenter implements \Domain\Article\UseCase\CreateArticle\CreateArticlePresenter
{
    public CreateArticleResponse $response;

    public function present(CreateArticleResponse $response): void
    {
        $this->response = $response;
    }
}