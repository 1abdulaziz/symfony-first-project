<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {

        $movies = ['Avengers: Endgame', 'The Lion King', 'Frozen II', 'Toy Story 4', 'Captain Marvel'];
        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
