<?php


namespace App\UserInterface\Presenter;


use Domain\Article\UseCase\GetArticles\GetArticlesResponse;

final class GetArticlesPresenter implements \Domain\Article\UseCase\GetArticles\GetArticlesPresenter
{
    public GetArticlesResponse $response;

    public function present(GetArticlesResponse $response): void
    {
        $this->response = $response;
    }
}