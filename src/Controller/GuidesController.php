<?php
// src/Controller/GuidesController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GuidesController extends Controller
{
    public function guides()
    {
        return $this->render('guides.html.twig');
    }
}