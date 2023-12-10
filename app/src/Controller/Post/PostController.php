<?php

declare(strict_types=1);

namespace App\Controller\Post;

use App\Entity\PostEntity;
use App\Repository\PostEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    public function __construct(
        private readonly PostEntityRepository $postEntityRepository,
    ) {
    }

    #[Route('/list', name: 'app_post_list')]
    public function getPosts(): Response
    {
        return $this->render('post/index.html.twig', [
            'allPosts' => $this->postEntityRepository->findAll(),
        ]);
    }

    #[Route('/delete-post/{post}', name: 'app_post_delete')]
    public function deletePost(PostEntity $post): Response
    {
        $this->postEntityRepository->remove($post, true);

        return $this->redirectToRoute('app_post_list');
    }

    #[Route('/delete-all-posts', name: 'app_posts_delete_all')]
    public function deleteAllPosts(): Response
    {
        $this->postEntityRepository->deleteAllPosts();
        return $this->redirectToRoute('app_post_list');
    }
}
