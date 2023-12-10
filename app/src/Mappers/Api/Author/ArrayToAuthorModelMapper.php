<?php

declare(strict_types=1);

namespace App\Mappers\Api\Author;

use App\Models\Author\AuthorModel;

final class ArrayToAuthorModelMapper
{
    public function map(array $arrayAuthor): AuthorModel
    {
        $author = new AuthorModel();
        $author->setId($arrayAuthor["id"]);
        $author->setName($arrayAuthor["name"]);
        $author->setAddress($arrayAuthor["address"]);
        $author->setEmail($arrayAuthor["email"]);
        $author->setPhone($arrayAuthor["phone"]);
        $author->setCompany($arrayAuthor["company"]);
        $author->setUsername($arrayAuthor["username"]);
        $author->setWebsite($arrayAuthor["website"]);

        return $author;
    }
}
