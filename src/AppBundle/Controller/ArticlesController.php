<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    /**
     * @Route("/articles", name="articles")
     */
    public function getAllArticlesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Article");
        $articles = $repository->findAll();
        return $this->render('articles/articles.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/articles/categories/{id}", name="articlesByCategory")
     */
    public function getArticlesByCategoryAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Article");
        $articles = $repository->findByCategory($id);
        return $this->render('articles/articles.html.twig', array('articles' => $articles));
    }
}
