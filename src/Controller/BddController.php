<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class BddController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'bdd')]
    public function createArticles(): Response
    {
        $data = [
            1 => [
                [
                    'Nom' => 'Boeuf Bourguignon',
                    'Description' => 'Un plat classique français, mijoté lentement avec du boeuf, du vin rouge, des légumes et des herbes.',
                    'Prix' => 15,
                    'Image' => 'boeuf_bourguignon',
                ],
                [
                    'Nom' => 'Poulet rôti',
                    'Description' => 'Poulet entier rôti au four, assaisonné d\'herbes fraîches et accompagné de pommes de terre rôties.',
                    'Prix' => 12,
                    'Image' => 'poulet_roti',
                ],
                [
                    'Nom' => 'Lasagnes',
                    'Description' => 'Couches de pâtes, de sauce tomate, de viande hachée et de fromage fondu, gratinées au four.',
                    'Prix' => 14,
                    'Image' => 'lasagnes',
                ],
                [
                    'Nom' => 'Paella',
                    'Description' => 'Un plat espagnol savoureux à base de riz, de fruits de mer, de poulet et d\'épices.',
                    'Prix' => 18,
                    'Image' => 'paella',
                ],
                [
                    'Nom' => 'Pot-au-feu',
                    'Description' => 'Un plat français réconfortant avec des morceaux de viande cuits lentement, accompagnés de légumes.',
                    'Prix' => 16,
                    'Image' => 'pot-au-feu',
                ],
                [
                    'Nom' => 'Ratatouille',
                    'Description' => 'Un plat végétarien provençal composé de légumes méditerranéens mijotés dans une sauce tomate.',
                    'Prix' => 13,
                    'Image' => 'ratatouille',
                ],
                [
                    'Nom' => 'Quiche Lorraine',
                    'Description' => 'Une tarte salée avec une garniture à base de lardons, de crème et d\'oeufs.',
                    'Prix' => 10,
                    'Image' => 'quiche_lorraine',
                ],
                [
                    'Nom' => 'Bœuf Stroganoff',
                    'Description' => 'Morceaux de bœuf tendres dans une sauce à la crème, aux champignons et aux oignons.',
                    'Prix' => 17,
                    'Image' => 'boeuf_stroganoff',
                ],
                [
                    'Nom' => 'Choucroute garnie',
                    'Description' => 'Plat alsacien avec du chou fermenté, des saucisses, du lard et des pommes de terre.',
                    'Prix' => 14,
                    'Image' => 'choucroute_garnie',
                ],
                [
                    'Nom' => 'Bouillabaisse',
                    'Description' => 'Une soupe de poisson provençale avec une variété de poissons, de fruits de mer et d\'aromates.',
                    'Prix' => 20,
                    'Image' => 'bouillabaisse',
                ],
            ],

            2 => [
                [
                    'Nom' => 'Fajitas au poulet',
                    'Description' => 'Morceaux de poulet grillés servis avec des poivrons, des oignons et des tortillas.',
                    'Prix' => 14,
                    'Image' => 'fajitas_au_poulet',
                ],
                [
                    'Nom' => 'Quesadillas aux crevettes',
                    'Description' => 'Tortillas garnies de crevettes, de fromage fondu et d\'une variété d\'épices.',
                    'Prix' => 16,
                    'Image' => 'quesadillas_aux_crevettes',
                ],
                [
                    'Nom' => 'Chili con carne',
                    'Description' => 'Mélange épicé de viande hachée, de haricots, de tomates et d\'épices.',
                    'Prix' => 12,
                    'Image' => 'chili_con_carne',
                ],
                [
                    'Nom' => 'Enchiladas au bœuf',
                    'Description' => 'Rouleaux de tortillas farcis de bœuf, de fromage et de sauce enchilada.',
                    'Prix' => 15,
                    'Image' => 'enchiladas_au_boeuf',
                ],
                [
                    'Nom' => 'Nachos suprêmes',
                    'Description' => 'Nachos garnis de viande, de fromage fondu, de guacamole, de salsa et de crème aigre.',
                    'Prix' => 10,
                    'Image' => 'nachos_supremes',
                ],
                [
                    'Nom' => 'Tacos au poisson',
                    'Description' => 'Tacos remplis de filets de poisson grillés, de salade et de sauce crémeuse.',
                    'Prix' => 18,
                    'Image' => 'tacos_au_poisson',
                ],
                [
                    'Nom' => 'Burritos aux haricots noirs',
                    'Description' => 'Burritos végétariens avec des haricots noirs, du riz, de la salade et de la salsa.',
                    'Prix' => 13,
                    'Image' => 'burritos_aux_haricots_noirs',
                ],
                [
                    'Nom' => 'Guacamole et chips',
                    'Description' => 'Avocats écrasés mélangés à des tomates, des oignons et des épices, servi avec des chips.',
                    'Prix' => 8,
                    'Image' => 'guacamole_et_chips',
                ],
                [
                    'Nom' => 'Tamales au porc',
                    'Description' => 'Tamales de maïs farcis de viande de porc, cuits à la vapeur dans des feuilles de maïs.',
                    'Prix' => 17,
                    'Image' => 'tamales_au_porc',
                ],
                [
                    'Nom' => 'Margarita aux fruits',
                    'Description' => 'Boisson rafraîchissante à base de tequila, de jus de citron vert et de fruits.',
                    'Prix' => 7,
                    'Image' => 'margarita_aux_fruits',
                ],
            
            ],

            3 => [
                [
                    'Nom' => 'Poulet au curry',
                    'Description' => 'Morceaux de poulet tendres dans une sauce au curry aromatique, servi avec du riz.',
                    'Prix' => 16,
                    'Image' => 'poulet_au_curry',
                ],
                [
                    'Nom' => 'Sushi assortis',
                    'Description' => 'Variété de sushis comprenant des makis, des sashimis et des nigiris.',
                    'Prix' => 18,
                    'Image' => 'sushi_assortis',
                ],
                [
                    'Nom' => 'Nasi Goreng',
                    'Description' => 'Riz sauté indonésien avec des légumes, du poulet, des crevettes et des épices.',
                    'Prix' => 14,
                    'Image' => 'nasi_Goreng',
                ],
                [
                    'Nom' => 'Kebab à l\'agneau',
                    'Description' => 'Viande d\'agneau grillée, servie dans un pain pita avec des légumes et une sauce à l\'ail.',
                    'Prix' => 15,
                    'Image' => 'kebab_agneau',
                ],
                [
                    'Nom' => 'Ramens au porc',
                    'Description' => 'Nouilles japonaises dans un bouillon de porc, garnies de tranches de porc, d\'œufs et de légumes.',
                    'Prix' => 13,
                    'Image' => 'Ramens_au_porc',
                ],
                [
                    'Nom' => 'Plateau mezzé libanais',
                    'Description' => 'Assortiment de plats libanais, y compris des falafels, du houmous et des feuilles de vigne farcies.',
                    'Prix' => 20,
                    'Image' => 'plateau_mezze_libanais',
                ],
            ],

            4 => [
                [
                    'Nom' => 'Cheeseburger classique',
                    'Description' => 'Burger avec un steak de bœuf, du fromage, de la laitue, des tomates et des oignons.',
                    'Prix' => 11,
                    'Image' => 'cheeseburger_classique',
                ],
                [
                    'Nom' => 'Ailes de poulet Buffalo',
                    'Description' => 'Ailes de poulet épicées, servies avec une sauce Buffalo et une trempette au fromage bleu.',
                    'Prix' => 13,
                    'Image' => 'ailes_de_poulet_Buffalo',
                ],
                [
                    'Nom' => 'Chili Dog',
                    'Description' => 'Pain à hot-dog garni de saucisse, de chili, de fromage et d\'oignons.',
                    'Prix' => 8,
                    'Image' => 'chili_Dog',
                ],
                [
                    'Nom' => 'Macaroni and Cheese',
                    'Description' => 'Pâtes macaroni mélangées à une sauce au fromage crémeuse.',
                    'Prix' => 10,
                    'Image' => 'macaroni_and_Cheese',
                ],
                [
                    'Nom' => 'Barbecue Ribs',
                    'Description' => 'Côtes de porc grillées, nappées de sauce barbecue, accompagnées de frites.',
                    'Prix' => 18,
                    'Image' => 'barbecue_Ribs',
                ],
                [
                    'Nom' => 'Lobster Roll',
                    'Description' => 'Sandwich à la chair de homard, assaisonné avec de la mayonnaise, du céleri et des épices.',
                    'Prix' => 20,
                    'Image' => 'lobster_Roll',
                ],

            ],

        ];

        if ($this->entityManager->getRepository(Article::class)->count([]) === 0) {
            foreach ($data as $category => $items) {
                foreach ($items as $item) {
                    $article = new Article();
                    $article->setNom($item['Nom']);
                    $article->setDescription($item['Description']);
                    $article->setPrix($item['Prix']);
                    $article->setImage($item['Image']);
                    $article->setIdCategorie($category);

                    $this->entityManager->persist($article);
                }
            }

            
            $role = new Role();
            $role->setType('admin');
            $this->entityManager->persist($role);
            
            $role = new Role();
            $role->setType('client');
            $this->entityManager->persist($role);

            $user = new Utilisateur();
            $user->setNom('admin');
            $user->setPrenom('admin');
            $user->setAdresseMail('admin@admin.fr');
            $hashedPassword = password_hash('admin0', PASSWORD_DEFAULT);
            $user->setMotDePasse($hashedPassword);
            $user->setAdressePostale('admin');
            $user->setNumeroDeTelephone('admin');
            $user->setIdRole(1);
            $this->entityManager->persist($user);

            $categorie= new Categorie();
            $categorie->setNomCategorie('Traditionnel');
            $this->entityManager->persist($categorie);

            $categorie= new Categorie();
            $categorie->setNomCategorie('Tex-Mex');
            $this->entityManager->persist($categorie);

            $categorie= new Categorie();
            $categorie->setNomCategorie('Oriental');
            $this->entityManager->persist($categorie);

            $categorie= new Categorie();
            $categorie->setNomCategorie('Américain');
            $this->entityManager->persist($categorie);


            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_login');
    }
}

