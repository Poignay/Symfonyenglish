<?php
// src/Controller/UpdateController.php
namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Utils\StringUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UpdateController extends Controller
{
    public function index(Request $request)
    {
        $typeObject = $request->attributes->get(StringUtils::$typeObject);
        $id = $request->attributes->get(StringUtils::$idField);
        //FORM TO UPDATE THE ELEMENT
        $em = $this->getDoctrine()->getManager();
        if ($typeObject == StringUtils::$typeObjectArticle) {
            $elementToUpdate = $em->getRepository(Articles::class)->find($id);
        } else if ($typeObject == StringUtils::$typeObjectCategory) {
            $elementToUpdate = $em->getRepository(Categories::class)->find($id);
        }
        //TODO : diff to these two element
        $form = $this->get('form.factory')->createBuilder(FormType::class, $elementToUpdate)
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

        return $this->render('update.html.twig');
    }
}
