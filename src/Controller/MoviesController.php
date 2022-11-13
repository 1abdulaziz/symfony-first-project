<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    private $movieRepository;

    public function __construct(EntityManagerInterface $em , MovieRepository $movieRepository)
    {
        $this->em = $em;
        $this->movieRepository = $movieRepository;

    }

    // example MovieRepository $entityManager
    #[Route('/movies', name: 'app_movies' , methods: ['GET'])]
    public function index(): Response
    {
        $movies = $this->movieRepository->findAll();
        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
    // example EntityManagerInterface $entityManager
    #[Route('/movie/{movie}', name: 'movie', methods: ['GET'])]
    public function movie($movie): Response
    {
        $movie = $this->em->getRepository(Movie::class)->find($movie);
        // if $movie null
        if (!$movie) {
            throw $this->createNotFoundException(
                'No movie found for id '.$movie
            );
        }
        return $this->render('movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

//    /**
//     * @Route("/movie/{movie}/edit", name="movie_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Movie $movie): Response
//    {
//        $form = $this->createForm(MovieType::class, $movie);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//            return $this->redirectToRoute('movie', ['movie' => $movie->getId()]);
//        }
//        return $this->render('movies/edit.html.twig', [
//            'movie' => $movie,
//            'form' => $form->createView(),
//        ]);
//    }
}
