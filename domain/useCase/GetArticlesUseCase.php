<?php

namespace UseCase;

use Domain\Article\UseCase\GetArticles\GetArticlesPresenter;
use Domain\Article\UseCase\GetArticles\GetArticlesRequest;

interface GetArticlesUseCase
{
    public function execute(GetArticlesRequest $request, GetArticlesPresenter $presenter): void;
}
