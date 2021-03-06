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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test")
     */
    public function tokenActivationAction(Request $request)
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:DataUser')
            ->findAll();
        return new $this->render('');
        //return $this->redirectToRoute('login');
    }

    /**
     * @Route("/index", name="index")
     */
    public function indexSait(Request $request)
    {
        return $this->render('index/index.twig');
    }
    /**
     * @Route("/aboutus", name= "about")
     */
    public function aboutUs(Request $request)
    {
        return $this->render('index/aboutus.twig');
    }

    /**
     * @Route("/product", name= "product")
     */
    public function product(Request $request)
    {
        return $this->render('index/Product.twig');
    }
}