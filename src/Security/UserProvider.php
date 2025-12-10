<?php declare(strict_types=1);

namespace App\Security;

use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct
    (
        private Connection $db
    ){}

    public function loadUserByIdentifier(string $email): UserInterface
    {
        $data = $this->db->fetchAssociative(
            "SELECT name, email, password, roles FROM users WHERE email = ?"
            [$email]
        ); 

        if(!$data) {
            throw new UserNotFoundException("User not found: $email");
        }

        return new User(
            $data['name'],
            $data['email'],
            $data['password'],
            json_decode($data['roles'], true),
            $data['isBlocked'], true
        );
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }
}