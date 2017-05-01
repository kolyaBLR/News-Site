<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailsController extends Controller
{
    /**
     * @Route("/email/{name}/{email}", name="emailActivation")
     */
    public function sendRegistrationEmailAction(string $name, string $email)
    {
        $token = $this->getDoctrine()
            ->getRepository('AppBundle:TokenUser')
            ->getTokenSearchByEmail($email);
        $id = $token[0]->getId();
        $message = \Swift_Message::newInstance()
            ->setSubject("Hello $name!")
            ->setFrom('bobrovkolja@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView('Emails/registrationEmail.html.twig', array(
                    'name' => $name,
                    'token' => $id,
                )),
                'text/html'
            );
        $this->get('mailer')->send($message);
        $message = 'Email for account activation sent to e-mail.';
        return $this->render('authorize/successMessage.html.twig', array(
            'message' => $message,
            'routName' => 'login',
        ));
    }

    /**
     * @Route("/email/reset/{name}/{email}", name="emailPasswordReset")
     */
    public function sendPasswordResetEmailAction(string $name, string $email)
    {
        $token = $this->getDoctrine()
            ->getRepository('AppBundle:TokenUser')
            ->getTokenSearchByEmail($email);
        $id = $token[0]->getId();
        $message = \Swift_Message::newInstance()
            ->setSubject("Hello $name!")
            ->setFrom('bobrovkolja@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView('Emails/passwordResetEmail.html.twig', array(
                    'name' => $name,
                    'token' => $id,
                )),
                'text/html'
            );
        $this->get('mailer')->send($message);
        $message = 'The letter with the link to password recovery sent to the mail.';
        return $this->render('authorize/successMessage.html.twig', array(
            'message' => $message,
            'routName' => 'login',
        ));
    }

    /**
     * @Route("/email/cron/", name="cronEmail")
     */
    public function cronEmailAction()
    {
        $User = $this->getDoctrine()
            ->getRepository('AppBundle:DataUser')
            ->getUserSubscriptionEmail();
        foreach ($User as $user) {
            $name = $user['firstName'] . ' ' . $user['lastName'];
            $message = \Swift_Message::newInstance()
                ->setSubject("Hello $name!")
                ->setFrom('bobrovkolja@gmail.com')
                ->setTo($user['email'])
                ->setBody(
                    $this->renderView('Emails/sendingMessages.html.twig', array(
                        'name' => $name,
                    )),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }
        return $this->redirectToRoute('login');
    }
}