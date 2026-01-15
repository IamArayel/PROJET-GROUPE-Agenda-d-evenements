<?php

namespace App\Controller\Admin;

use App\Repository\EvenementRepository;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminInscriptionController extends AbstractController
{
    /**
     * List and filter inscriptions in the administration panel.
     */
    #[Route('/admin/inscription', name: 'app_admin_inscription_index', methods: ['GET'])]
    public function index(Request $request, InscriptionRepository $inscriptionRepository, EvenementRepository $evenementRepository): Response
    {
        $evenementId = $request->query->get('evenement');
        
        if ($evenementId) {
            $inscriptions = $inscriptionRepository->findBy(['relation' => $evenementId], ['createdAt' => 'DESC']);
        } else {
            $inscriptions = $inscriptionRepository->findBy([], ['createdAt' => 'DESC']);
        }

        $totalPlaces = 0;
        foreach ($inscriptions as $inscription) {
            $totalPlaces += $inscription->getNombrePlaces();
        }

        return $this->render('admin/inscription/index.html.twig', [
            'inscriptions' => $inscriptions,
            'evenements' => $evenementRepository->findAll(),
            'totalPlaces' => $totalPlaces,
            'selectedEvenement' => $evenementId,
        ]);
    }
}
