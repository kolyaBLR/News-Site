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

    /**
     * @Route("/register", name="registration")
     */
    public function registrationAction(Request $request)
    {
        $user = new DataUser();
        $user->setSubscriptionEmail();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            var_dump($user);
            $em->persist($user);
            $em->flush();
            $name = $user->getFirstName() . ' ' . $user->getLastName();
            $userEmail = $user->getEmail();
            return $this->redirectToRoute('email', array(
               'name' =>  "$name",
               'email' => "$userEmail"
           ));
        }
        return $this->render('authorize/registrations.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}