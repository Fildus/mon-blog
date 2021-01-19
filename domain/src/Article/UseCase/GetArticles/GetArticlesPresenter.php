<?php

namespace Domain\Article\UseCase\GetArticles;

interface GetArticlesPresenter
{
    public function present(GetArticlesResponse $response): void;
}
