<?php declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;

class UserRepository
{
    public function __construct(private Connection $db){}

    public function findByEmail(string $email): ?array 
    {
        return $this->db->fetchAssociative(
            "SELECT * FROM users WHERE email = ?",[$email]
        ) ?: null;
    }

    public function insert(string $name, string $email, string $password, array $roles)
{
    return $this->db->executeStatement(
        "INSERT INTO users (name, email, password, roles, isBlocked)
         VALUES (?, ?, ?, ?, 0)",
         [$name, $email, $password, json_encode($roles)]
    );
}

    public function setBlockedStatus(string $email, bool $status)
    {
        return $this->db->executeStatement(
            "UPDATE users SET isBlocked = ? WHERE email = ?",[(int) $status, $email]
        );
    }
}