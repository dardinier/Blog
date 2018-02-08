<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/articles", name="articles")
     */
    public function getAllArticlesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Article");
        $articles = $repository->findAll();
        return $this->render('pages/articles.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/articles/categories/{id}", name="articlesByCategory")
     */
    public function getArticlesByCategoryAction(Request $request, $id)
    {
        $articlesRepository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Article");
        $articles = $articlesRepository ->findByCategory($id);

        $categoryRepository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Category");
        $category = $categoryRepository->find($id);

        return $this->render('pages/articlesByCategory.html.twig', array('articles' => $articles, 'category' => $category));
    }
}
