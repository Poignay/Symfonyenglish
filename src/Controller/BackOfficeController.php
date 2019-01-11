<?php
// src/Controller/BackOfficeController.php
namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Utils\StringUtils;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BackOfficeController extends Controller
{
    public function index(Request $request)
    {
        // TODO : controll if the user have the permission to access

        // FORM FOR ADD CATEGORIES
        $category = new Categories();
        $form = $this->get('form.factory')->createBuilder(FormType::class, $category)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('Save', SubmitType::class)
            ->getForm();

        // FORM FOR ADD ARTICLES
        $article = new Articles();
        $formArticle = $this->get('form.factory')->createBuilder(FormType::class, $article)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('refCategories_fk', EntityType::class, array(
                'class' => Categories::class,
                'choice_label' => 'name',
                'multiple' => false))
            ->add('Save', SubmitType::class)
            ->getForm();

        $repository = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repository->findAll();
        unset($repository);
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findAll();
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            if ($request->request->get('id') && $request->request->get('typeObject')) {
                $typeObject = $request->request->get('typeObject');
                if ($typeObject == StringUtils::$typeObjectArticle) {
                    $c = $em->getRepository(Articles::class)->find($request->$request->get('id'));
                    $em->remove($c);
                    $em->flush();
                } else if ($typeObject == StringUtils::$typeObjectCategory) {
                    $c = $em->getRepository(Categories::class)->find($request->request->get('id'));
                    $em->remove($c);
                    $em->flush();
                }
            }
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    $em->persist($category);
                    $em->flush();
                    return $this->redirectToRoute('guides_routes');
                }
            }

            $formArticle->handleRequest($request);
            if ($formArticle->isSubmitted()) {
                if ($formArticle->isValid()) {
                    $em->persist($article);
                    $em->flush();
                    //TODO : display alert
                }
            }
        }

        return $this->render('backoffice.html.twig', array(
            'categories' => $categories,
            'articles' => $articles,
            'formCategory' => $form->createView(),
            'formArticle' => $formArticle->createView()));
    }
}
