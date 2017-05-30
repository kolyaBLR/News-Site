<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataUser;
use AppBundle\Entity\TokenUser;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\PasswordResetEmailType;
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
            return $this->redirectToRoute('emailActivation', array(
                'name' => "$name",
                'email' => "$userEmail",
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
                $user->setEnabled(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->remove($token);
                $em->flush();
            }
        }
        $message = 'Accaunt activated.';
        return $this->render('authorize/successMessage.html.twig', array(
            'message' => $message,
            'routName' => 'login',
        ));
    }

    /**
     * @Route("/passwres", name="password")
     */
    public function passwordResetAction(Request $request)
    {
        $user = new DataUser();
        $form = $this->createForm(PasswordResetEmailType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user = $this->getDoctrine()
                ->getRepository('AppBundle:DataUser')
                ->getUserSearchByEmail($user->getEmail());
            if ($user) {
                $em = $this->getDoctrine()->getManager();
                $em->persist(new TokenUser($user->getEmail()));
                $em->flush();
                $name = $user->getFirstName() . ' ' . $user->getLastName();
                $userEmail = $user->getEmail();
                return $this->redirectToRoute('emailPasswordReset', array(
                    'name' => "$name",
                    'email' => "$userEmail",
                ));
            }
        }
        return $this->render('authorize/passwordReset.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/passwres/{idToken}", name="passwordResetToken")
     */
    public function tokenPasswordResetAction(Request $request, int $idToken)
    {
        $user = new DataUser();
        $form = $this->createForm(PasswordResetType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $token = $this->getDoctrine()
                ->getRepository('AppBundle:TokenUser')
                ->find($idToken);
            $user = $this->getDoctrine()
                ->getRepository('AppBundle:DataUser')
                ->getUserSearchByEmail($token->getEmail());
            if ($user) {
                $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->remove($token);
                $em->flush();
            }
        }
        return $this->render('authorize/passwordReset.html.twig', array(
            'form' => $form,
        ));
    }
}