<?php

declare(strict_types=1);

namespace App\Mappers\Api\Post;

use App\Models\Post\PostModel;

final class ArrayToPostModelMapper
{
    public function map(array $arrayPost): PostModel
    {
        $post = new PostModel();
        $post->setId($arrayPost["id"]);
        $post->setTitle($arrayPost["title"]);
        $post->setUserId($arrayPost["userId"]);
        $post->setBody($arrayPost["body"]);

        return $post;
    }
}
