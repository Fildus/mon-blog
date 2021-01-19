<?php

namespace Domain\Tests\Article;

use Domain\Article\UseCase\CreateArticle\CreateArticleRequest;
use Domain\Article\UseCase\CreateArticle\CreateArticleResponse;
use Domain\Article\UseCase\CreateArticle\CreateArticle;
use Domain\Tests\__Mock\Adapter\Presenter\Article\CreateArticlePresenter;
use Domain\Tests\__Mock\Adapter\Repository\ArticleRepository;
use PHPUnit\Framework\TestCase;

class CreateArticleTest extends TestCase
{
    private CreateArticlePresenter $presenter;
    private CreateArticle $useCase;
    private ArticleRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new ArticleRepository();
        $this->presenter = new CreateArticlePresenter();
        $this->useCase = new CreateArticle($this->repository);
    }

    public function test(): void
    {
        $request = new CreateArticleRequest(
            title: 'small title',
            content: 'small content'
        );

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(CreateArticleResponse::class, $this->presenter->response);

        $this->assertSame($request->title, $this->presenter->response->entity->title);
        $this->assertSame($request->content, $this->presenter->response->entity->content);
    }
}