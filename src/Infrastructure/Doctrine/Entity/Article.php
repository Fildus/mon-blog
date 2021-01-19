<?php

namespace App\Infrastructure\Doctrine\Entity;

use App\Infrastructure\Adapter\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private UuidInterface $uuid;

    /**
     * @ORM\Column(type="string")
     */
    private string $title;

    /**
     * @ORM\Column(type="string")
     */
    private string $content;

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuid(UuidInterface $uuid): Article
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Article
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Article
    {
        $this->content = $content;

        return $this;
    }
}
