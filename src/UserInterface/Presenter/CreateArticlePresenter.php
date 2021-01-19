<?php


namespace App\UserInterface\Presenter;


use Domain\Article\UseCase\CreateArticle\CreateArticleResponse;

final class CreateArticlePresenter implements \Domain\Article\UseCase\CreateArticle\CreateArticlePresenter
{
    public CreateArticleResponse $response;

    public function present(CreateArticleResponse $response): void
    {
        $this->response = $response;
    }
}