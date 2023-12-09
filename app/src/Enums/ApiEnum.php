<?php

namespace App\Enums;

enum ApiEnum: string
{
    case API_URL = "https://jsonplaceholder.typicode.com";

    case POSTS_URL = "/posts";

    case USERS_URL = "/users";
}
