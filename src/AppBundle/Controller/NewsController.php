<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Form\AuthorizationType;
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

class NewsController extends Controller
{
    /**
     * @Route("/news/create")
     */
    public function createNewsAction(Request $request)
    {
        $news = new DataNews(
            '1',
            'title',
            'link image',
            'content text'
        );

        $create = $this->getDoctrine()->getManager();
        $create->persist($news);
        $create->flush();

        return new Response('Saved. ID -> '. $news->getId());
    }

    /**
     * @Route("/news")
     */
    public function viewTitleNewsAction(Request $request)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->findAll();
        return new Response($news);
    }

    /**
     * @Route("/news/{id}")
     * @ParamConverter("post", class="AppBundle:DataNews")
     */
    public function viewNewsAction(DataNews $newsId)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->find($newsId);
        if (!$newsId) {
            throw $this->createNotFoundException('Not found by ID ' .$newsId);
        }
        return new Response($news);
    }
}