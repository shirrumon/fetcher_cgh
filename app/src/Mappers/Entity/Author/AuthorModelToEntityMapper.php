<?php

declare(strict_types=1);

namespace App\Mappers\Entity\Author;

use App\Entity\AuthorEntity;
use App\Models\Author\AuthorModel;

final class AuthorModelToEntityMapper
{
    public function map(AuthorModel $authorModel): AuthorEntity
    {
        $entity = new AuthorEntity();
        $entity->setName($authorModel->getName());

        return $entity;
    }
}