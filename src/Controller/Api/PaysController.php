<?php

namespace App\Controller\Api;

use App\Entity\Pays;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/pays', name: 'api_pays_')]
class PaysController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(PaysRepository $paysRepository): JsonResponse
    {
        $pays = $paysRepository->findAll();
        return $this->json($pays, context: ['groups' => 'api_pays_index']);
    }

    #[Route('/{nom}', name: "show")]
    public function show(Pays $pays): JsonResponse
    {
        return $this->json($pays, context: ['groups' => ['api_pays_index', 'api_pays_show']]);
    }
}