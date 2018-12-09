<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    public function index()
    {
        return $this->render('base.html.twig', null);
    }   
}