<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\ArticleType;

class SupprimerArticleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listeArticle', name: 'app_list_articles')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        if ($session->get('role') != 1) {
            return $this->redirectToRoute('app_accueil');
        }
        $repository = $this->entityManager->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('supprimer_article/index.html.twig', [
            'error' => '',
            'articles' => $articles,
        ]);
    }

    #[Route('/supprimerArticle/{id}', name: 'app_supprimer_article')]
    public function supprimer(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        if ($session->get('role') != 1) {
            return $this->redirectToRoute('app_accueil');
        }
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->find($id);
        $articles = $repository->findAll();

        if ($article) {
            $entityManager->remove($article);
            $entityManager->flush();
        }
        return $this->render('supprimer_article/index.html.twig', [
            'error' => 'Article supprimé',
            'articles' => $articles,
        ]);
    }

    #[Route('/modifierArticle/{id}', name: 'app_modifier_article')]
    public function modifier(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('adresseMail')) {
            return $this->redirectToRoute('app_login');
        }
        if ($session->get('role') != 1) {
            return $this->redirectToRoute('app_accueil');
        }
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->find($id);
    
        $form = $this->createForm(ArticleType::class, $article);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_list_articles');
        }
    
        return $this->render('supprimer_article/modifier.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
