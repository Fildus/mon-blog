<?php

namespace App\UserInterface\Controller;

use App\UserInterface\Presenter\GetArticlesPresenter;
use Domain\Article\UseCase\GetArticles\GetArticlesRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use UseCase\GetArticlesUseCase;

final class HomeController extends AbstractController
{
    public function __invoke(
        GetArticlesUseCase $useCase,
        GetArticlesPresenter $presenter
    ): Response {
        $useCase->execute(new GetArticlesRequest(), $presenter);

        return $this->render('home/index.html.twig');
    }
}
