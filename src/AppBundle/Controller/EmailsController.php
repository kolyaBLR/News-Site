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
     * @Route("/email/{name}/{email}", name="email")
     */
    public function sendRegistrationEmailAction(string $name, string $email)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject("Hello $name!")
            ->setFrom('bobrovkolja@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView('Emails/registration.html.twig', array(
                    'name' => $name
                )),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('main');
    }
}