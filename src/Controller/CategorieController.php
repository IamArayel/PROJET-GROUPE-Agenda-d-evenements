<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategorieController extends AbstractController
{
    /**
     * List all categories.
     */
    #[Route('/categories', name: 'app_categorie', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show details of a specific category.
     */
    #[Route('/categories/{id}', name: 'app_categorie_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->find($id);
        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie introuvable.');
        }

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}