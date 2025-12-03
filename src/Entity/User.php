<?php declare(strict_types=1);
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface{
    
    public function getUserIdentifier(): string
{
    return '';
}

public function getRoles(): array
{
    return [];
}

public function getPassword(): ?string
{
    return null;
}

public function eraseCredentials(): void
{
}
}

