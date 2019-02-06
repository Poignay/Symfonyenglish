<?php
// src/Controller/ArticlesDetailsController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesDetailsController extends Controller
{
    public function details($article)
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $art = $repository->findById($article);
        if($art != null)
        {
            return $this->render('articles_details.html.twig', array('articles' => $art));
        }
        throw new NotFoundHttpException('Article '.$article.' inexistant.');
    }

    private function viewDetails($article)
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        return $repository->findById($article);
    }
}