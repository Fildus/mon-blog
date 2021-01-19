<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Infrastructure\Doctrine\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0;$i<100;++$i){
            $article = new Article();
            $article
                ->setUuid(Uuid::uuid4())
                ->setTitle("title ${i}")
                ->setContent("content ${i}");
            $manager->persist($article);
        }

        $manager->flush();
    }
}
