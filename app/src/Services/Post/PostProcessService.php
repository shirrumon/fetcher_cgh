<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Entity\AuthorEntity;
use App\Entity\PostEntity;
use App\Mappers\Entity\Author\AuthorModelToEntityMapper;
use App\Mappers\Entity\Post\PostModelToEntityMapper;
use Doctrine\ORM\EntityManagerInterface;

final class PostProcessService
{
    public function __construct(
        private readonly AuthorModelToEntityMapper $authorModelToEntityMapper,
        private readonly PostModelToEntityMapper $postModelToEntityMapper,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function process(array $postsArr, array $usersArr): void
    {
        $usersArr = $this->compareUsersByPosts($postsArr, $usersArr);

        $userEntities = $this->authorToEntitiesArr($usersArr);
        $postEntities = $this->postToEntitiesArr($postsArr);

        foreach ($userEntities as $entity) {
            $this->saveEntity($entity);
        }

        foreach ($postEntities as $entity) {
            $this->saveEntity($entity);
        }
    }

    private function compareUsersByPosts(array $postsArr, array $usersArr): array
    {
        $compareUsers = [];
        foreach ($postsArr as $post) {
            foreach ($usersArr as $user) {
                if ($post->getUserId() === $user->getId()) {
                    $compareUsers[] = $user;
                }
            }
        }

        return $compareUsers;
    }

    private function authorToEntitiesArr(array $authors): array
    {
        $authorsEntities = [];
        foreach ($authors as $author) {
            $authorsEntities[] = $this->authorModelToEntityMapper->map($author);
        }

        return $authorsEntities;
    }

    private function postToEntitiesArr(array $posts): array
    {
        $postsEntities = [];
        foreach ($posts as $post) {
            $postsEntities[] = $this->postModelToEntityMapper->map($post);
        }

        return $postsEntities;
    }

    private function saveEntity(PostEntity|AuthorEntity $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
}
