<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/character')]
class CharacterController extends AbstractController
{
    /**
     * Controller for read all Characters. This function use knp_paginator for pagination.
     * 
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    #[Route('/', name: 'app_character_index', methods: ['GET'])]
    public function index(CharacterRepository $characterRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $characters = $characterRepository->findAll();

        $paginateCharacters = $paginator->paginate($characters, $request->query->getInt('page', 1), 10);

        return $this->render('character/index.html.twig', [
            'characters' => $paginateCharacters,
        ]);
    }


    /**
     * Controller to create a character
     *
     * @param Request $request
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    #[Route('/new', name: 'app_character_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CharacterRepository $characterRepository): Response
    {
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characterRepository->add($character, true);

            return $this->redirectToRoute('app_character_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('character/new.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }


    /**
     * Controller to see the character
     * 
     * @param Character $character
     * @return Response
     */
    #[Route('/{id}', name: 'app_character_show', methods: ['GET'])]
    public function show(Character $character): Response
    {
        return $this->render('character/show.html.twig', [
            'character' => $character,
        ]);
    }



    /**
     * 
     * Controller to edit a character
     * 
     * @param Request $request
     * @param Character $character
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_character_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Character $character, CharacterRepository $characterRepository): Response
    {
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characterRepository->add($character, true);

            return $this->redirectToRoute('app_character_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('character/edit.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }


    /**
     * Controller for delete a character
     * 
     * @param Request $request
     * @param Character $character
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    #[Route('/{id}', name: 'app_character_delete', methods: ['POST'])]
    public function delete(Request $request, Character $character, CharacterRepository $characterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $character->getId(), $request->request->get('_token'))) {
            $characterRepository->remove($character, true);
        }

        return $this->redirectToRoute('app_character_index', [], Response::HTTP_SEE_OTHER);
    }
}
