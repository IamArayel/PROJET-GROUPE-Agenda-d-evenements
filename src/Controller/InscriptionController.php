<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    /**
     * Handle new inscription for an event.
     */
    #[Route('/inscription/{id}', name: 'app_inscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $inscription = new Inscription();
        $inscription->setRelation($evenement);
        $inscription->setCreatedAt(new \DateTime());

        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inscription);
            $entityManager->flush();

            $this->addFlash('success', 'Votre inscription a bien été enregistrée.');

            return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getId()]);
        }

        return $this->render('inscription/new.html.twig', [
            'inscription' => $inscription,
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }
}
