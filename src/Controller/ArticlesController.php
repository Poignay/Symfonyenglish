<?php
// src/Controller/ArticlesController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesController extends Controller
{
    public function articles($category)
    {
        $repository = $this->getDoctrine()->getRepository(Categories::class);
        $cat = $repository->findAll();
        foreach ($cat as $key => $value) {
            if( $value->getName() == $category )
            {
                return $this->render('articles.html.twig', array('articles' => $this->viewArticles($value)));
            }
        }
        throw new NotFoundHttpException('Categorie '.$category.' inexistante.');
    }

    private function viewArticles($category)
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        return $repository->findByCategory($category);
    }
}