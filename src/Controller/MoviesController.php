<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toRelaxedExtendedJSON;

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

    // edit movie

    #[Route('/movies/{id}/edit', name: 'app_movies_edit' , methods: ['GET' , 'POST'])]
    public function edit($id,Request $request): Response
    {
        $movie = $this->movieRepository->find($id);
        $form = $this->createForm(MovieFormType::class , $movie);
        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null) {
                    if (
                        file_exists($this->getParameter('kernel.project_dir') . $movie->getImagePath()
                        )) {
                        $this->getParameter('kernel.project_dir') . $movie->getImagePath();
                    }
                        $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                        try{
                            $imagePath->move(
                                $this->getParameter('kernel.project_dir') . '/public/uploads',
                                $newFileName
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                            return new Response($e->getMessage());
                        }
                        $movie->setImagePath('/uploads/' . $newFileName);
                        $this->em->flush();
                        return $this->redirectToRoute('app_movies');
                }
            }else{
                    $movie->setTitle($form->get('title')->getData());
                    $movie->setReleaseYear($form->get('releaseYear')->getData());
                    $movie->setDescription($form->get('description')->getData());
                    $this->em->flush();
                return $this->redirectToRoute('app_movies');
            }
        }

        return $this->render('movies/edit.html.twig' , [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/movies/{id}/delete', name: 'app_movies_delete' , methods: ['GET','DELETE'])]
    public function delete($id): Response
    {
        $movie = $this->movieRepository->find($id);
        $this->em->remove($movie);
        $this->em->flush();
        return $this->redirectToRoute('app_movies');
    }

    #[Route('/movies/create', name: 'app_movies_create' , methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newMovie = $form->getData();
            $imagePath = $form->get('imagePath')->getData();
            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                try{
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    return new Response($e->getMessage());
                }
                $newMovie->setImagePath('/uploads/' . $newFileName);
            }
            $this->em->persist($newMovie);
            $this->em->flush();

            return $this->redirectToRoute('app_movies');
        }
        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
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
