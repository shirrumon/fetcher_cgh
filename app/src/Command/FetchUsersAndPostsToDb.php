<?php

declare(strict_types=1);

namespace App\Command;

use App\ApiProvider\Post\PostsApiProvider;
use App\ApiProvider\User\UserApiProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AsCommand(name: 'fetch:users-and-posts')]
class FetchUsersAndPostsToDb extends Command
{

    public function __construct(
        private readonly PostsApiProvider $apiProvider,
        private readonly UserApiProvider $userApiProvider,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command fetch posts and related users from https://jsonplaceholder.typicode.com/');
    }

    /**
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        $test = $this->userApiProvider->getAuthorsAsModels();

        foreach ($test as $item) {
            $output->writeln([
                $item->getUsername()
            ]);
        }

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
