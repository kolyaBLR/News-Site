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
     * @Route("/getGrid/{countUsersPage}/{indexPage}", name="getUsers")
     */
    public function getJsonGridAction(
        Request $request,
        int $countUsersPage = 20,
        int $indexPage = 1
    )
    {
        /*$news = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->findAll();*/
        $user = new DataUser();
        $user->setFirstName('Kolya');
        $user->setLastName('Bobrov');
        $users = array($user, $user, $user, $user);
        $countPage = 10;
        $url = 'http://localhost:8000/getGrid';
        $data = array($users, $countPage, $url);
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $data = $serializer->serialize($data, 'json');
        return new Response($data);
    }

    /**
     * @Route("/grid", name="grid")
     */
    public function adminGridAction(Request $request)
    {
        /*$news = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->findAll();*/
        return $this->render('users/index.html.twig');
    }
}