<?php

namespace Domain\Tests\Article;

use Domain\Article\Entity\Article;
use Domain\Tests\__Mock\Adapter\Presenter\Article\GetArticlesPresenter;
use Domain\Article\UseCase\GetArticles\GetArticlesRequest;
use Domain\Article\UseCase\GetArticles\GetArticlesResponse;
use Domain\Article\UseCase\GetArticles\GetArticles;
use Domain\Tests\__Mock\Adapter\Repository\ArticleRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class GetArticlesTest extends TestCase
{
    private GetArticlesPresenter $presenter;
    private GetArticles $useCase;
    private ArticleRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new ArticleRepository();
        $this->presenter = new GetArticlesPresenter();
        $this->useCase = new GetArticles($this->repository);
    }

    public function test(): void
    {
        $articleA = new Article(
            uuid: Uuid::uuid4(),
            title: 'titleA',
            content: 'contentA'
        );
        $articleB = new Article(
            uuid: Uuid::uuid4(),
            title: 'titleB',
            content: 'contentB'
        );
        $this->repository->articles[$articleA->uuid->toString()] = $articleA;
        $this->repository->articles[$articleB->uuid->toString()] = $articleB;

        $request = new GetArticlesRequest();

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(GetArticlesResponse::class, $this->presenter->response);
        $this->assertCount(2, $this->repository->articles);
    }
}
