<?php
// src/Controller/GuidesController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categories;

class GuidesController extends Controller
{
    public function guides()
    {
        $repository = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repository->findAll();

        return $this->render('guides.html.twig', array('categories' => $categories ));
    }
}