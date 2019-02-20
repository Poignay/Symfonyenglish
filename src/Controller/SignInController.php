<?php
// src/Controller/SignInController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SignInController extends Controller
{
    public function signin()
    {


        return $this->render('signin.html.twig');
    }

}