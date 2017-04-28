<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataUser;
use AppBundle\Entity\TokenUser;
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

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('authorize/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/passwres")
     */
    public function passwordResetAction(Request $request)
    {
        $user = new DataUser();
        $form = $this->createForm(PasswordResetType::class, $user);
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:TokenUser')
            ->getTokenSearchByEmail($user->getEmail());
        $form->handleRequest($request);
        if ($user) {
            $userServer = $this->getDoctrine()
                ->getRepository('AppBundle:TokenUser')
                ->getTokenSearchByEmail($user->getEmail());
            $name = $user->getFirstName() . ' ' . $user->getLastName();
            $userEmail = $userServer->getEmail();
            return $this->redirectToRoute('email', array(
                'name' => "$name",
                'email' => "$userEmail"
            ));
        }
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
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist(new TokenUser($user->getEmail()));
            $em->flush();
            $name = $user->getFirstName() . ' ' . $user->getLastName();
            $userEmail = $user->getEmail();
            return $this->redirectToRoute('email', array(
                'name' => "$name",
                'email' => "$userEmail"
            ));
        }
        return $this->render('authorize/registrations.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/token/{idToken}", name="registerToken")
     */
    public function tokenActivationAction(Request $request, int $idToken)
    {
        $token = $this->getDoctrine()
            ->getRepository('AppBundle:TokenUser')
            ->find($idToken);
        if ($token) {
            $user = $this->getDoctrine()
                ->getRepository('AppBundle:DataUser')
                ->getUserSearchByEmail($token->getEmail());
            if ($user) {
                $user[0]->setEnabled(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user[0]);
                $em->remove($token);
                $em->flush();
            }
        }
        return $this->redirectToRoute('main');
    }
}