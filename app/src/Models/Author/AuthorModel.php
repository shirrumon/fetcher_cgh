<?php

declare(strict_types=1);

namespace App\Models\Author;

final class AuthorModel
{
    private int $id;

    private string $name;

    private string $username;

    private string $email;

    private array $address;

    private string $phone;

    private string $website;

    private array $company;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): array
    {
        return $this->address;
    }

    public function setAddress(array $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getCompany(): array
    {
        return $this->company;
    }

    public function setCompany(array $company): void
    {
        $this->company = $company;
    }
}