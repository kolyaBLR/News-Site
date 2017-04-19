<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\AuthorizationType;
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


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/user/{id}")
     * @ParamConverter("post", class="AppBundle:DataUser")
     */
    public function showAction (DataUser $userId)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->find($userId);
        if (!$userId) {
            throw $this->createNotFoundException('Not found by ID ' .$userId);
        }
        return new Response(print_r($user));
    }

    /**
     * @Route("/show")
     */
    public function viewAllUsers()
    {
        $users =$this->getDoctrine()->getRepository('AppBundle:DataUser')->findAll();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers,$encoders);
        $jsonContent = $serializer->serialize($users, 'json');
        return new Response(var_dump($jsonContent));
    }
}