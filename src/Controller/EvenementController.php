<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
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
}
