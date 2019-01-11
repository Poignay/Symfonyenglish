<?php
// src/Controller/UpdateController.php
namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UpdateController extends Controller
{
    public function updateCategory(Request $request, $categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Categories::class)->find($categoryId);

        $form = $this->get('form.factory')->createBuilder(FormType::class, $category)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('Save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('backoffice_route');
            }
        }

        return $this->render('update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateArticle(Request $request, $articleId)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Articles::class)->find($articleId);

        $form = $this->get('form.factory')->createBuilder(FormType::class, $article)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('Save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('backoffice_route');
            }
        }

        return $this->render('update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
