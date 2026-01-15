<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EvenementRepository $repository): Response
    {
        $evenements = $repository->findEvenementsFuturs();


        return $this->render('accueil/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
}
