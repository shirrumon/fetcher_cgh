<?php

declare(strict_types=1);

namespace App\ApiProvider\User;

use App\ApiProvider\Provider;
use App\Enums\ApiEnum;
use App\Enums\HttpMethodsEnum;
use App\Mappers\Api\Author\ArrayToAuthorModelMapper;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class UserApiProvider extends Provider
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     */
    private function getAllUsers(): array
    {
        return $this
            ->fetch(
                HttpMethodsEnum::GET,
                ApiEnum::USERS_URL
            )->toArray();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getAuthorsAsModels(): array
    {
        $authors = [];
        foreach ($this->getAllUsers() as $user) {
            $authors[] = (new ArrayToAuthorModelMapper())->map($user);
        }

        return $authors;
    }
}
