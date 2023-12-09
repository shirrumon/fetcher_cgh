<?php

declare(strict_types=1);

namespace App\ApiProvider;

use App\Enums\ApiEnum;
use App\Enums\HttpMethodsEnum;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Provider
{
    public function __construct(
        private readonly HttpClientInterface $client,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    protected function fetch(HttpMethodsEnum $requestMethod, ApiEnum $requestUrl): ResponseInterface
    {
        return $this->client->request(
            $requestMethod->value,
            ApiEnum::API_URL->value . $requestUrl->value
        );
    }
}
