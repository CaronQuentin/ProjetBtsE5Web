<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;

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

class AccueilController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

       

    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('accueil/index.html.twig');
    }

    
}

