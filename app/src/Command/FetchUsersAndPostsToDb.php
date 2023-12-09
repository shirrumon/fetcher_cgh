<?php

declare(strict_types=1);

namespace App\Command;

use App\ApiProvider\Post\PostsApiProvider;
use App\ApiProvider\User\UserApiProvider;
use App\Services\Post\PostProcessService;
use mysql_xdevapi\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AsCommand(name: 'fetch:users-and-posts')]
class FetchUsersAndPostsToDb extends Command
{

    public function __construct(
        private readonly PostsApiProvider $postsApiProvider,
        private readonly UserApiProvider $userApiProvider,
        private readonly PostProcessService $postProcessService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command fetch posts and related users from https://jsonplaceholder.typicode.com/');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        try {
            $authors = $this->userApiProvider->getAuthorsAsModels();
            $posts = $this->postsApiProvider->getPostsAsModels();

            $this->postProcessService->process($posts, $authors);

            return Command::SUCCESS;

            //        foreach ($test as $item) {
//            $output->writeln([
//                $item->getUsername()
//            ]);
//        }
        } catch (ClientExceptionInterface|TransportExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return Command::FAILURE;
        }
    }
}
