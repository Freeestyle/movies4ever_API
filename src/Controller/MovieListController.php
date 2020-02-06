<?php

namespace App\Controller;


use App\Entity\MovieList;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieListController extends AbstractController

{

    /**
     * Création d'une liste
     * @Route("/lists", name="lists_create", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function postListAction(Request $request,
                                    SerializerInterface $serializer,
                                    EntityManagerInterface $entityManager)
    {
        $data = $request->getContent();
        $list = $serializer->deserialize($data, MovieList::class, 'json');
        $entityManager->persist($list);
        $entityManager->flush();

        return new JsonResponse(
            "Une nouvelle liste a été créée",
            Response::HTTP_CREATED, [], true);
    }

    /**
     * Affichage d'une liste
     * @Route("/lists/{id}", requirements={"id": "\d+"}, name="lists_show", methods={"GET"})
     * @param MovieList $movieList
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */

    public function showListAction(MovieList $movieList,
                                    SerializerInterface $serializer)
    {
        $data = $serializer->serialize($movieList, 'json');

        return new JsonResponse(
            $data,
            Response::HTTP_OK, [], true);
    }

    /**
     * Modification d'une liste
     * @Route("/lists/{id}", requirements={"id": "\d+"}, name="lists_edit", methods={"PUT"})
     * @param MovieList $movieList
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     * @return JsonResponse
     */

    public function editListAction(MovieList $movieList,
                                    Request $request,
                                    EntityManagerInterface $entityManager,
                                    \Symfony\Component\Serializer\SerializerInterface $serializer)
    {
        $data = $request->getContent();
        $updatedList = $serializer->deserialize($data,
            MovieList::class,
            'json',
            ['object_to_populate' => $movieList]);
        $entityManager->persist($updatedList);
        $entityManager->flush();

        return new JsonResponse(
            "La liste a été modifiée",
            Response::HTTP_OK, [], true);
    }

    /**
     * Suppression d'une liste
     * @Route("/lists/{id}", name="lists_delete", methods={"DELETE"})
     * @param MovieList $movieList
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */

    public function deleteMovieAction(MovieList $movieList,
                                      EntityManagerInterface $entityManager)
    {
        $entityManager->remove($movieList);
        $entityManager->flush();

        return new JsonResponse(
            "La liste a été supprimée",
            Response::HTTP_OK, [], true);
    }


}




