<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\NewsCategory;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\createNewsType;
use AppBundle\Form\PasswordResetType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\Cloner\Data;
use AppBundle\Entity\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserController extends Controller
{
    /**
     * @Route("/getUsers", name="getUsers")
     */
    public function getJsonUsersAction(Request $request)
    {
        /*$news = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->findAll();*/
        $user = new DataUser();
        $user->setUserName('Kolya');
        $user->setLastName('Bobrov');
        $users = array($user, $user, $user, $user);
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $users = $serializer->serialize($users, 'json');
        return new Response($users);
    }

    /**
     * @Route("/getCountPage", name="getCountPage")
     * FIX!!!!!
     */
    public function getCountPage(Request $request)
    {
        $countUsersPage = $request->get('count');
        $countUsersDB = 123;
        return new Response($countUsersDB / $countUsersPage);
    }

    /**
     * @Route("/grid", name="news")
     */
    public function adminGridAction(Request $request)
    {
        /*$news = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->findAll();*/
        return $this->render('users/index.html.twig');
    }
}