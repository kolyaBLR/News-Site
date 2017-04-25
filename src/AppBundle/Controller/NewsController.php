<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\NewsCategory;
use AppBundle\Form\AuthorizationType;
use AppBundle\Form\createNews;
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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NewsController extends Controller
{
    /**
     * @Route("/news/create", name="create")
     */
    public function createNewsAction(Request $request)
    {
        /*$news = new DataNews();
        $create = $this->getDoctrine()->getManager();
        $create->persist($news);
        $create->flush();
        return new Response('Saved. ID -> '. $news->getId());*/
        $news = new DataNews();
        $form = $this->createForm(createNews::class, $news);
        $form->handleRequest($request);
        return $this->render('news/createNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/news", name="news")
     */
    public function viewTitleNewsAction(Request $request)
    {
        /*$news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->findAll();*/
        return $this->render('news/news.html.twig');
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

    /**
     * @Route("/category")
     *
     */
    public function createCategory(Request $request)
    {

    }

}