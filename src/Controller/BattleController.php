<?php

namespace App\Controller;

use App\Entity\Battle;
use App\Form\BattleType;
use App\Repository\BattleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/battle')]
class BattleController extends AbstractController
{
    #[Route('/', name: 'app_battle_index', methods: ['GET'])]
    public function index(BattleRepository $battleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $battles = $battleRepository->findAll();

        $paginateBattle = $paginator->paginate($battles, $request->query->getInt('page', 1), 10);

        return $this->render('battle/index.html.twig', [
            'battles' => $paginateBattle,
        ]);
    }

    #[Route('/new', name: 'app_battle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BattleRepository $battleRepository): Response
    {
        $battle = new Battle();
        $form = $this->createForm(BattleType::class, $battle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battleRepository->add($battle, true);

            return $this->redirectToRoute('app_battle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('battle/new.html.twig', [
            'battle' => $battle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_battle_show', methods: ['GET'])]
    public function show(Battle $battle): Response
    {
        return $this->render('battle/show.html.twig', [
            'battle' => $battle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_battle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Battle $battle, BattleRepository $battleRepository): Response
    {
        $form = $this->createForm(BattleType::class, $battle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battleRepository->add($battle, true);

            return $this->redirectToRoute('app_battle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('battle/edit.html.twig', [
            'battle' => $battle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_battle_delete', methods: ['POST'])]
    public function delete(Request $request, Battle $battle, BattleRepository $battleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $battle->getId(), $request->request->get('_token'))) {
            $battleRepository->remove($battle, true);
        }

        return $this->redirectToRoute('app_battle_index', [], Response::HTTP_SEE_OTHER);
    }
}
