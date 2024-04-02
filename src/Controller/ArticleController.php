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


class ArticleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/articles/{idCategorie}', name: 'app_article')]
    public function articlesParCategorie(int $idCategorie, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy(['Id_Categorie' => $idCategorie]);

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'idCategorie' => $idCategorie,
        ]);
    }
}