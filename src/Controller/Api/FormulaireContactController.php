<?php

namespace App\Controller\Api;

use App\Entity\FormulaireContact;
use App\Entity\User;
use App\Repository\FormulaireContactRepository;
use App\Repository\StatutRepository;
use App\Repository\VoyageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/formulaire', name: 'api_formulaire_')]
class FormulaireContactController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(FormulaireContactRepository $fr): JsonResponse
    {
        $formulaires = $fr->findAll();
        return $this->json($formulaires, context: ['groups' => 'api_formulaire_index']);
    }

    #[Route('/new', name: 'new', methods: ['POST'])]
    public function new(
        Request $request,
        UserRepository $userRepository,
        VoyageRepository $voyageRepository,
        StatutRepository $statutRepository,
        ValidatorInterface $validatorInterface,
        EntityManagerInterface
        $em
    ) {
        $content = $request->getContent();
        $formulaireUser = json_decode($content, true);


        if ($userRepository->findOneBy(["email" => $formulaireUser['email'], "nom" => $formulaireUser['nom']])) {

            $user = $userRepository->findOneBy(["email" => $formulaireUser['email'], "nom" => $formulaireUser['nom']]);
        } else {

            $user = new User;
            $user->setEmail($formulaireUser['email']);
            $user->setNom($formulaireUser['nom']);
            $user->setPrenom($formulaireUser['prenom']);

            $errors = $validatorInterface->validate($user);

            if ($errors->count()) {
                $messages = [];
                foreach ($errors as $error) {
                    $messages[] = $error->getMessage();
                }

                return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $em->persist($user);
                $em->flush();

                $user = $userRepository->findOneBy(["email" => $formulaireUser['email'], "nom" => $formulaireUser['nom']]);
            }
        }
        ;
        $voyage = $voyageRepository->findOneBy(["id" => $formulaireUser['id']]);
        $statut = $statutRepository->findOneBy(["id" => 1]);

        $formulaire = new FormulaireContact;
        $formulaire->setUser($user);
        $formulaire->setVoyage($voyage);
        $formulaire->setMessage($formulaireUser['message']);
        $formulaire->setStatut($statut);


        $errors = $validatorInterface->validate($formulaire);

        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $em->persist($formulaire);
            $em->flush();

            return $this->json('Votre message a été envoyé.', Response::HTTP_CREATED);
        }
    }
}
