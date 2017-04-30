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
        $dateTime = new \DateTime('now');
        $dateTime = $dateTime->format("Y-m-d");
        $news->setDatePublication($dateTime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $news->setIdAuthor($this->getUser()->getId());
            $saveNews = $this->getDoctrine()->getManager();
            $saveNews->persist($news);
            $saveNews->flush();
        }
        return $this->render('news/createNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/news/{page}", name="news")
     */
    public function viewTitleNewsAction(Request $request, int $page = 1)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getNewsSearchByIndexPage($page);
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $countPage = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getCountNews();
        return $this->render('news/news.html.twig', array(
            'News' => $news,
            'categories' => $categories,
            'countPage' => $countPage,
        ));
    }

    /**
     * @Route("/news/category/{category}/{page}", name="newsCategory")
     */
    public function viewTitleNewsCategoryAction(Request $request, string $category, int $page = 1)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getNewsSearchByCategory($page, $category);
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        return $this->render('news/news.html.twig', array(
            'News' => $news,
            'categories' => $categories,
        ));
    }
}