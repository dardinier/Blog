<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends Controller
{
    /**
     * @Security("has_role('ROLE_VISITOR')")
     * @Route("/categories", name="categories")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Category");
        $categories = $repository->findAll();
        return $this->render('pages/categories.html.twig', array('categories' => $categories));
    }
}
