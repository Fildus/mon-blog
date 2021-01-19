<?php

namespace UseCase;

use Domain\Article\UseCase\CreateArticle\CreateArticlePresenter;
use Domain\Article\UseCase\CreateArticle\CreateArticleRequest;

interface CreateArticleUseCase
{
    public function execute(CreateArticleRequest $request, CreateArticlePresenter $presenter): void;
}