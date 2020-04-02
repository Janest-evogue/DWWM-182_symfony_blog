<?php


namespace App\Controller\Admin;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller\Admin
 *
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findBy([], ['publicationDate' => 'DESC']);

        return $this->render(
            'admin/article/index.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    /**
     * @Route("/edition")
     */
    public function edit()
    {
        $user = $this->getUser();
        /*
         * Intégrer le formulaire pour l'enregistrement d'un article
         * Validation : tous les champs obligatoires
         * Avant l'enregistrement setter la date de publication à maintenant
         * et l'auteur avec l'utilisateur connecté ($this->getUser() dans un contrôleur)
         *
         * Adapter la page pour la modification :
         * - pas de modification de la date de publication ni de l'auteur
         */

        return $this->render(
            'admin/article/edit.html.twig'
        );
    }
}
