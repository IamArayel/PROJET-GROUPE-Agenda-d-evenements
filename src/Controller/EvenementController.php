<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvenementController extends AbstractController
{
    /**
     * Display the list of future events.
     */
    #[Route('/evenement', name: 'app_events', methods: ['GET'])]
    public function index(EvenementRepository $repository, CategorieRepository $categorieRepository): Response
    {
        $evenements = $repository->findEvenementsFuturs();
        $categories = $categorieRepository->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            'categories' => $categories,
        ]);
    }

    /**
     * Display details of a specific event.
     */
    #[Route('/evenement/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}
