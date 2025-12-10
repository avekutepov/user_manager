<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UserController
{
    public function __construct(
        private UserService $service
    ){}

    #[Route('/register', methods:['POST'])]
    public function register(Request $request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        try{
            $this->service->register($name, $email, $password);
            return new JsonResponse(['status' => 'ok'], 201);
        }catch (\Exception $e){
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}