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
    public function addEmailUserAction()
    {

    }

    /**
     * @Route("/email", name="email")
     */
    public function sendEmailAction(Request $request)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('bobrovkolja@gmail.com')
            ->setTo('bk97w@bk.ru')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Emails/registration.html.twig',
                    array('name' => 'Nikolay')
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        return $this->redirectToRoute('email');
    }
}