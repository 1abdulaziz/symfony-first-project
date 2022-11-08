<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbdulazizController extends AbstractController
{
    #[Route('/abdulaziz', name: 'app_abdulaziz')]
    public function index(): Response
    {
        return $this->render('abdulaziz/index.html.twig', [
            'controller_name' => 'AbdulazizController',
        ]);
    }
}
