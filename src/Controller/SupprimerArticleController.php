<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;

class SupprimerArticleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listeArticle', name: 'app_list_articles')]
    public function index(): Response
    {
        $repository = $this->entityManager->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('supprimer_article/index.html.twig', [
            'error' => '',
            'articles' => $articles,
        ]);
    }

    #[Route('/supprimerArticle/{id}', name: 'app_supprimer_article')]
    public function supprimer(int $id, EntityManagerInterface $entityManager): Response
    {
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
    public function modifierPage(int $id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->find($id);
        return $this->render('supprimer_article/modifier.html.twig', [
                'error' => '',
                'article' => $article,
            ]);
    }

    #[Route('/modifierArticle/{id}', name: 'app_modifier_article')]
    public function modifier(int $id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Article::class);
        $article = $repository->find($id);
        $articles = $repository->findAll();

        if ($article) {
            $entityManager->persist($article);
            $entityManager->flush();
        }
        return $this->render('supprimer_article/index.html.twig', [
            'error' => 'Article modifié',
            'articles' => $articles,
        ]);
    }
}
