<?php

namespace App\Controller;

use App\Entity\FormulaireContact;
use App\Entity\User;
use App\Entity\Voyage;
use App\Form\FormulaireContactType;
use App\Repository\FormulaireContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/formulaire')]

class FormulaireController extends AbstractController
{
    #[Route('/', name: 'app_formulaire_index', methods: ['GET'])]
    public function index(FormulaireContactRepository $formulaireContactRepository, EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        $voyages = $entityManager->getRepository(Voyage::class)->findAll();
        return $this->render('formulaire/index.html.twig', [
            'formulaire_contacts' => $formulaireContactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formulaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formulaireContact = new FormulaireContact();
        $form = $this->createForm(FormulaireContactType::class, $formulaireContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $formulaireContact->setUser($user);


            $statut = $formulaireContact->getStatut();
            $formulaireContact->setStatut($statut);

            $voyage = $formulaireContact->getVoyage();
            $formulaireContact->setVoyage($voyage);

            $entityManager->persist($formulaireContact);
            $entityManager->flush();

            return $this->redirectToRoute('app_formulaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formulaire/new.html.twig', [
            'formulaire_contact' => $formulaireContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulaire_show', methods: ['GET'])]
    public function show(FormulaireContact $formulaireContact): Response
    {
        return $this->render('formulaire/show.html.twig', [
            'formulaire_contact' => $formulaireContact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formulaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormulaireContact $formulaireContact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormulaireContactType::class, $formulaireContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formulaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formulaire/edit.html.twig', [
            'formulaire_contact' => $formulaireContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulaire_delete', methods: ['POST'])]
    public function delete(Request $request, FormulaireContact $formulaireContact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulaireContact->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($formulaireContact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formulaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
