<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use DateTime;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CommandeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/validationCommande', name: 'validationCommande')]
    public function validationCommande(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $panierItems = $entityManager->getRepository(Panier::class)->findAll();

        $lstnom = [];
        $lstprix = [];
        $lstquantite = [];

        foreach ($panierItems as $panierItem) {
            $nom = $panierItem->getNom();
            $prix = $panierItem->getPrix();
            $quantite = $panierItem->getQuantite();

            $lstnom[] = $nom; // changed from $lstnoms
            $lstprix[] = $prix; // changed from $lstprixs
            $lstquantite[] = $quantite; // changed from $lstquantites
        }

        $currentDateTime = new DateTime();
        $dateHeure = $currentDateTime->format('Y-m-d H:i:s');

        $commandeEntity = new Commande();
        $commandeEntity->setDateCommande($dateHeure);
        $commandeEntity->setListNom($lstnom); // this will now have values
        $commandeEntity->setListPrix($lstprix); // this will now have values
        $commandeEntity->setListQuantite($lstquantite); // this will now have values
        $entityManager->persist($commandeEntity);

        $entityManager->flush();

        // Empty the panier table
        $panierRepository = $entityManager->getRepository(Panier::class);
        $panierItems = $panierRepository->findAll();
        foreach ($panierItems as $panierItem) {
            $entityManager->remove($panierItem);
        }
        $entityManager->flush();

        return $this->render('accueil/index.html.twig');
    }
}