<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvenementController extends AbstractController
{
    /**
     * Display the list of future events.
     */
    #[Route('/evenement', name: 'app_evenement_index', methods: ['GET'])]
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
    #[Route(
        '/evenement/{id}',
        name: 'app_evenement_show',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    #Route ajax
    #[Route('/evenements/categorie/{id}', name: 'app_events_by_categorie', methods: ['GET'])]
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
