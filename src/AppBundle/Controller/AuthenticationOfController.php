<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataUser;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\PasswordResetType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationOfController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('authorize/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/passwres")
     */
    public function passwordResetAction(Request $request)
    {
        $form = $this->createForm(PasswordResetType::class, new DataUser());
        return $this->render('authorize/passwordReset.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}