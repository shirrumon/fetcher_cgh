<?php

declare(strict_types=1);

namespace App\Services\Post;

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

        foreach ($usersArr as $userModel) {
            $authorEntity = $this->authorModelToEntityMapper->map($userModel);
            $this->em->persist($authorEntity);
            foreach ($postsArr as $postModel) {
                if($userModel->getId() === $postModel->getUserId()) {
                    $postEntity = $this->postModelToEntityMapper->map($postModel);
                    $postEntity->setAuthor($authorEntity);

                    $this->em->persist($postEntity);
                }
            }

            $this->em->flush();
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

        return $this->myArrayUnique($compareUsers);
    }

    private function myArrayUnique(array $array): array
    {
        $duplicateKeys = array();
        $tmp = array();

        foreach ($array as $key => $val){
            if (is_object($val))
                $val = (array)$val;

            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicateKeys[] = $key;
        }

        foreach ($duplicateKeys as $key)
            unset($array[$key]);

        return false ? $array : array_values($array);
    }
}
