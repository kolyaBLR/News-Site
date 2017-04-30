<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\newsCreateType;
use AppBundle\Form\PasswordResetEmailType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test/{idToken}")
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
        return new Response(var_dump($token) . var_dump($user));
        //return $this->redirectToRoute('login');
    }

}