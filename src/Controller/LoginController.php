<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class LoginController extends AbstractController
{
    
    /**
     * @Route("/login", name="login", methods={"POST"})
     * 
     */
    public function index(Request $request, LoggerInterface $logger)
    {
        $loginData = $request->request->all();
        
        return new JsonResponse($loginData);
    }
}
