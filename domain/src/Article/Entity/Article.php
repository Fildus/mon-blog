<?php


namespace Domain\Article\Entity;


use Ramsey\Uuid\UuidInterface;

class Article
{
    public function __construct(
        public UuidInterface $uuid,
        public string $title,
        public string $content
    ) { }
}