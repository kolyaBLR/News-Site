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

class AuthenticationOfController extends DefaultController
{
    /**
     * @Route("/auth")
     */
    public function authorizationAction(Request $request)
    {
        $form = $this->createForm(AuthorizationType::class, new DataUser());
        return $this->render('authorize/authorizations.html.twig', array(
            'form' => $form->createView(),
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