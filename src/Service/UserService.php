<?php declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use Exception;

class UserService 
{
    public function __construct(
        private UserRepository $repository
    ){}

    public function register(string $name, string $email, string $password)
    {
        if($this->repository->findByEmail($email))
            {
            throw new Exception("User already exists");
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->repository->insert($name, $email, $hashedPassword, ['ROLE_ADMIN']);
    }

    public function blockUser($email)
    {  
        if(!$this->repository->findByEmail($email)){    
            throw new Exception("User not found");
        }

        $this->repository->setBlockedStatus($email, true);
    }

    public function unblockUser($email)
    {
        if(!$this->repository->findByEmail($email)){    
            throw new Exception("User not found");
        }

        $this->repository->setBlockedStatus($email, false);
    }
}