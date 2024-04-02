<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Utilisateur;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PanierController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route("/add", name: "add_panier", methods: "POST")]
    public function addPanier(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $id = $request->request->get('id');
        $nom = $request->request->get('nom');
        $prix = $request->request->get('prix');
        $quantite = $request->request->get('quantite');
        $idCategorie = $request->request->get('id_categorie');

        $panier = $entityManager->getRepository(Panier::class)->findOneBy(['Nom' => $nom]);
        if ($panier) {
            $panier->setQuantite($panier->getQuantite() + 1);
        } else {
            $panier = new Panier();
            $panier->setIdArticle($id);
            $panier->setNom($nom);
            $panier->setPrix($prix);
            $panier->setQuantite($quantite);
            $entityManager->persist($panier);
        }

        $entityManager->flush();

        return $this->render('article/add_panier.html.twig', [
            'idCategorie' => $idCategorie,
        ]);
    }

    #[Route("/panier", name: "panier", methods: "GET")]
    public function panier(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $panierItems = $this->entityManager->getRepository(Panier::class)->findAll();
        if ($panierItems) {
            $prix = $this->entityManager->getRepository(Panier::class)->calculateTotalPrice();
        } else {
            $prix = 0;
        }



        return $this->render('panier/index.html.twig', [
            'panierItems' => $panierItems,
            'prix' => $prix,
        ]);
    }


    #[Route("/dimArticle", name: "dimArticle")]
    public function dimArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $nom = $request->request->get('nom');

        $panierItem = $entityManager->getRepository(Panier::class)->findOneBy(['Nom' => $nom]);

        if ($panierItem) {
            $quantite = $panierItem->getQuantite();
            if ($quantite > 1) {
                $panierItem->setQuantite($quantite - 1);
            } else {
                $entityManager->remove($panierItem);
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier');
    }



    #[Route("/suppArticle", name: "suppArticle")]
    public function suppArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $nom = $request->request->get('nom'); // 

        $panierItem = $entityManager->getRepository(Panier::class)->findOneBy(['Nom' => $nom]); // Trouver l'élément du panier par son nom

        if ($panierItem) {
            $entityManager->remove($panierItem); // Supprimer l'élément du panier
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier'); // Rediriger vers la page du panier
    }


    #[Route("/ajtArticle", name: "ajtArticle")]
    public function ajtArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        $nom = $request->request->get('nom'); // 

        $panierItem = $entityManager->getRepository(Panier::class)->findOneBy(['Nom' => $nom]); // Trouver l'élément du panier par son nom

        if ($panierItem) {
            $quantite = $panierItem->getQuantite();
            $panierItem->setQuantite($quantite + 1); // Ajouter 1 à la quantité de l'article
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier'); // Rediriger vers la page du panier
    }

}