<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_events', methods: ['GET'])]
    public function index(EvenementRepository $repository): Response
    {
        $evenements = $repository->findEvenementsFuturs();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    #Route ajax
    #[Route('/evenement/categorie/{id}', name: 'app_events_by_categorie', methods: ['GET'])]
    public function byCategorie(
        Categorie $categorie,
        EvenementRepository $repository
    ): Response {
        $evenements = $repository->findFutursByCategorie($categorie);

        return $this->render('evenement/_rows.html.twig', [
            'evenements' => $evenements,
        ]);
    }
}
