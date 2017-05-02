<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\newsCreateType;
use AppBundle\Form\PasswordResetEmailType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function getCategoryAction()
    {
        $news = new DataNews();
        $form = $this->createForm(NewsCreateType::class, $news);
        $category = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $category = $serializer->serialize($category, 'json');
        $category = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        return $this->render('category/editCategory.html.twig', array(
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
        return $this->redirectToRoute('getCategory');
    }

    /**
     * @Route("/category/add/{name}", name="addCategory")
     */
    public function addCategoryAction(Request $request, string $name)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist(new NewsCategory($name));
        $manager->flush();
        return $this->redirectToRoute('getCategory');
    }
}