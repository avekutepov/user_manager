<?php declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface 
{
    public function __construct
    (
        private string $name,
        private string $email,
        private string $password,
        private array $roles,
        private bool $isBlocked,
    ){}

    public function getUserIdentifier(): string 
    {
        return $this->email;
    }

    public function getUseName(): string 
    {
        return $this->name;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): ?string 
    {
        return $this->password;
    }

    public function getBlockedStatus(): bool
    {
        return $this->isBlocked;
    }

    public function eraseCredentials() {}
}