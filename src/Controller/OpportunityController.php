<?php

namespace App\Controller;

use App\Entity\Opportunity;
use App\Form\OpportunityType;
use App\Repository\OpportunityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/opportunity')]
class OpportunityController extends AbstractController
{
    #[Route('/', name: 'app_opportunity_index', methods: ['GET'])]
    public function index(OpportunityRepository $opportunityRepository): Response
    {
        return $this->render('opportunity/index.html.twig', [
            'opportunities' => $opportunityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_opportunity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OpportunityRepository $opportunityRepository): Response
    {
        $opportunity = new Opportunity();
        $form = $this->createForm(OpportunityType::class, $opportunity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $opportunityRepository->save($opportunity, true);

            return $this->redirectToRoute('app_opportunity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('opportunity/new.html.twig', [
            'opportunity' => $opportunity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opportunity_show', methods: ['GET'])]
    public function show(Opportunity $opportunity): Response
    {
        return $this->render('opportunity/show.html.twig', [
            'opportunity' => $opportunity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_opportunity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Opportunity $opportunity, OpportunityRepository $opportunityRepository): Response
    {
        $form = $this->createForm(OpportunityType::class, $opportunity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $opportunityRepository->save($opportunity, true);

            return $this->redirectToRoute('app_opportunity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('opportunity/edit.html.twig', [
            'opportunity' => $opportunity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opportunity_delete', methods: ['POST'])]
    public function delete(Request $request, Opportunity $opportunity, OpportunityRepository $opportunityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opportunity->getId(), $request->request->get('_token'))) {
            $opportunityRepository->remove($opportunity, true);
        }

        return $this->redirectToRoute('app_opportunity_index', [], Response::HTTP_SEE_OTHER);
    }
}
