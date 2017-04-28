<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\createNewsType;
use AppBundle\Form\PasswordResetType;
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
    public function getUsersAction(Request $request)
    {
        $token = $this->getDoctrine()
            ->getRepository('AppBundle:TokenUser')
            ->getTokenSearchByEmail("bk97w@bk.ru");
        return new Response(var_dump($token));
    }
}