<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\PostEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PostApiController extends AbstractController
{
    public function __construct(
        private readonly PostEntityRepository $postEntityRepository,
    ) {
    }

    #[Route('/posts', name: 'app_post_api', methods: ["GET"])]
    public function index(): JsonResponse
    {
        return $this->json($this->postEntityRepository->findAll());
    }
}
