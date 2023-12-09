<?php

declare(strict_types=1);

namespace App\Mappers\Entity\Post;

use App\Entity\PostEntity;
use App\Models\Post\PostModel;

final class PostModelToEntityMapper
{
    public function map(PostModel $postModel): PostEntity
    {
        $entity = new PostEntity();
        $entity->setUserId($postModel->getUserId());
        $entity->setTitle($postModel->getTitle());
        $entity->setBody($postModel->getBody());

        return $entity;
    }
}