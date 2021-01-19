<?php

namespace Domain\Article\UseCase\GetArticles;

use Domain\Article\Gateway\ArticleRepository;
use UseCase\GetArticlesUseCase;

class GetArticles implements GetArticlesUseCase
{
    public function __construct(
        private ArticleRepository $repository
    ) { }

    public function execute(GetArticlesRequest $request, GetArticlesPresenter $presenter): void
    {
        $articles = $this->repository->getArticles();

        $presenter->present(new GetArticlesResponse(
            articles: $articles ?? []
        ));


        /*
        $domainEntity = new DomainEntity(
            uuid: $theUuid,
            someVars: $request->someVars,
        );

        $this->repository->doSomething($domainEntity);

        $presenter->present(new GetArticlesResponse(
            domainEntity: $domainEntity ?? null
        ));
        */
    }
}
