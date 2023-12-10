<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use JsonSerializable;

#[ORM\Entity(repositoryClass: PostEntityRepository::class)]
#[ORM\Table(name: '`posts`')]
class PostEntity implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $userId;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $body;

    #[ORM\ManyToOne(targetEntity: AuthorEntity::class, inversedBy: 'author')]
    private AuthorEntity $author;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getAuthor(): AuthorEntity
    {
        return $this->author;
    }

    public function setAuthor(AuthorEntity $author): void
    {
        $this->author = $author;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "userId" => $this->getUserId(),
            "title" => $this->getTitle(),
            "body" => $this->getBody(),
            "author" => [
                "id" => $this->getAuthor()->getId(),
                "name" => $this->getAuthor()->getName(),
            ],
        ];
    }
}
