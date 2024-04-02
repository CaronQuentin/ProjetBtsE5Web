<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;

class AjoutArticleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/articlesAjout', name: 'app_articleAjoutForm')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        if ($session->get('role') != 1) {
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('ajout_article\index.html.twig');
    }

    #[Route('/articlesAjoutValidation', name: 'app_articleAjoutValidation')]
    public function ajoutArticle(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        if ($session->get('role') != 1) {
            return $this->redirectToRoute('app_accueil');
        }
        $nom = $request->request->get('nom');
        $description = $request->request->get('description');
        $image = $request->request->get('image');
        $prix = $request->request->get('prix');
        $id_categorie = $request->request->get('categorie');

        $article = new Article();
        $article->setNom($nom);
        $article->setDescription($description);
        $article->setImage($image);
        $article->setPrix($prix);
        $article->setIdCategorie($id_categorie);
        

        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('app_articleAjoutForm');
    }
}
