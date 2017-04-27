<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\NewsCategory;
use AppBundle\Form\createNewsType;
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
     * @Route("/news/create", name="create")
     */
    public function createNewsAction(Request $request)
    {
        $news = new DataNews();
        $form = $this->createForm(createNewsType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $saveNews = $this->getDoctrine()->getManager();
            $saveNews->persist($news);
            $saveNews->flush();
        }
        return $this->render('news/createNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/news", name="news")
     */
    public function viewTitleNewsAction(Request $request)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->findAll();
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $user = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->findAll();
        return $this->render('news/news.html.twig', array(
            'News' => $news,
            'user' => $user,
            'categories' => $categories,
        ));
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