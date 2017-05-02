<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\EditCategoryType;
use AppBundle\Form\newsCreateType;
use AppBundle\Form\PasswordResetEmailType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\DateTime;
use AppBundle\AppBundle;
use AppBundle\Entity\NewsCategory;
use Symfony\Component\VarDumper\Cloner\Data;

class CategoryController extends Controller
{
    /**
     * @Route("/category/edit/", name="editCategory")
     */
    public function getCategoryAction(Request $request)
    {
        $category = new NewsCategory('');
        $form = $this->createForm(EditCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $saveCategory = $this->getDoctrine()->getManager();
            $saveCategory->persist($category);
            $saveCategory->flush();
        }
        $category = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        return $this->render('category/editCategory.html.twig', array(
            'form' => $form->createView(),
            'categories' => $category,
        ));
    }

    /**
     * @Route("/category/delete/{name}", name="deleteCategory")
     */
    public function deleteCategoryAction(Request $request, string $name)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->getCategorySearchByName($name);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();
        return $this->redirectToRoute('editCategory');
    }

    /**
     * @Route("/category/add/{name}", name="addCategory")
     */
    public function addCategoryAction(Request $request, string $name)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist(new NewsCategory($name));
        $manager->flush();
        return $this->redirectToRoute('editCategory');
    }
}