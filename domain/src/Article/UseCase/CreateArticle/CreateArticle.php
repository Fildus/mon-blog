<?php

namespace Domain\Article\UseCase\CreateArticle;

use Domain\Article\Entity\Article;
use Domain\Article\Gateway\ArticleRepository;
use Ramsey\Uuid\Uuid;
use UseCase\CreateArticleUseCase;

class CreateArticle implements CreateArticleUseCase
{
    public function __construct(
        private ArticleRepository $repository
    ) { }

    public function execute(CreateArticleRequest $request, CreateArticlePresenter $presenter): void
    {
        $article = new Article(
            uuid: Uuid::uuid4(),
            title: $request->title,
            content: $request->content,
        );

        $this->repository->createArticle($article);

        $presenter->present(new CreateArticleResponse(
            entity: $article ?? null
        ));
    }
}
