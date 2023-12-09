<?php

declare(strict_types=1);

namespace App\ApiProvider\Post;

use App\ApiProvider\Provider;
use App\Enums\ApiEnum;
use App\Enums\HttpMethodsEnum;
use App\Mappers\Api\Post\ArrayToPostModelMapper;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PostsApiProvider extends Provider
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     */
    private function getAllPosts(): array
    {
        return $this
            ->fetch(
                HttpMethodsEnum::GET,
                ApiEnum::POSTS_URL
            )->toArray();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getPostsAsModels(): array
    {
        $postModelsArray = [];
        foreach ($this->getAllPosts() as $post) {
            $postModelsArray[] = (new ArrayToPostModelMapper())->map($post);
        }

        return $postModelsArray;
    }
}
