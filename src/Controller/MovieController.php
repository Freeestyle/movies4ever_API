<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController
{
    /**
     * Ajout d'un film
     * @Route("/movies", name="movies_create", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function postMovieAction(Request $request,
                                    SerializerInterface $serializer,
                                    EntityManagerInterface $entityManager)
    {
        $data = $request->getContent();
        $movie = $serializer->deserialize($data, Movie::class, 'json');
        $entityManager->persist($movie);
        $entityManager->flush();

        return new JsonResponse(
            "Un nouveau film a été enregistré",
            Response::HTTP_CREATED,
            [
                'location' => "movie/" . $movie->getId()],
            true);
    }

    /**
     * Affichage d'un film
     * @Route("/movies/{id}", requirements={"id": "\d+"}, name="movies_show", methods={"GET"})
     * @param Movie $movie
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */

    public function showMovieAction(Movie $movie,
                                    SerializerInterface $serializer)
    {
        // Serialization en format JSON
        $data = $serializer->serialize($movie, 'json');

        return new JsonResponse(
            $data,
            Response::HTTP_OK, [], true);
    }

    /**
     * Edition d'un film
     * @Route("/movies/{id}", requirements={"id": "\d+"}, name="movies_edit", methods={"PUT"})
     * @param Movie $movie
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     * @return JsonResponse
     */

    public function editMovieAction(Movie $movie,
                                    Request $request,
                                    EntityManagerInterface $entityManager,
                                    \Symfony\Component\Serializer\SerializerInterface $serializer)
    {
        $data = $request->getContent();
        $updatedMovie = $serializer->deserialize($data,
                                                Movie::class,
                                                'json',
                                                ['object_to_populate' => $movie]);
        $entityManager->persist($updatedMovie);
        $entityManager->flush();

        return new JsonResponse(
            "La fiche du film a été modifiée",
            Response::HTTP_OK, [], true);
    }

    /**
     * Suppression d'un film
     * @Route("/movies/{id}", name="movies_delete", methods={"DELETE"})
     * @param Movie $movie
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */

    public function deleteMovieAction(Movie $movie,
                                      EntityManagerInterface $entityManager)
    {
        $entityManager->remove($movie);
        $entityManager->flush();

        return new JsonResponse(
            "Le film a été supprimé",
            Response::HTTP_OK, [], true);
    }

    /**
     * Liste de tous les films
     * @Route("/movies", name="movies_list", methods={"GET"})
     * @param SerializerInterface $serializer
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */
    public function showMoviesAction(SerializerInterface $serializer,
                                     MovieRepository $movieRepository)
    {
        // Recup de tous les films (objets)
        $allmovies = $movieRepository->findAll();
        // Serialization en format JSON
        $data = $serializer->serialize($allmovies, 'json');

        // Renvoi réponse des data avec code statut 200 pour OK et précision format JSON
        return new JsonResponse(
            $data,
            Response::HTTP_OK, [], true);
    }

    /**
     * Recherche d'un film par son nom
     * @Route("/movies/search/{title}", name="movies_search", methods={"GET"})
     * @param Movie $movie
     * @param SerializerInterface $serializer
     * @param MovieRepository $movieRepository
     * @return JsonResponse
     */


    public function searchMovieAction(Movie $movie,
                                      SerializerInterface $serializer,
                                      MovieRepository $movieRepository)
    {
            $movieId = $movie->getId();
            $searchedMovie = $movieRepository->find($movieId);
            //dump($searchedMovie); die;
            $data = $serializer->serialize($searchedMovie, 'json');

            return new JsonResponse(
            $data,
            Response::HTTP_OK, [], true);

    }


}



