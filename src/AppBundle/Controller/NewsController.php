<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\DataNews;
use AppBundle\Entity\DataUser;
use AppBundle\Entity\NewsCategory;
use AppBundle\Entity\SimilarArticles;
use AppBundle\Form\NewsCreateType;
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
        $form = $this->createForm(NewsCreateType::class, $news);
        $news->setDatePublication(new \DateTime('now'));
        $news->setIdAuthor($this->getUser()->getId());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $saveNews = $this->getDoctrine()->getManager();
            $saveNews->persist($news);
            $saveNews->flush();
            $message = 'New created.';
            return $this->render('authorize/successMessage.html.twig', array(
                'message' => $message,
                'routName' => 'news',
            ));
        }
        return $this->render('news/createNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/news/edit/{idNews}", name="edit")
     */
    public function editNewsAction(Request $request, int $idNews)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->find($idNews);
        $form = $this->createForm(NewsCreateType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $saveNews = $this->getDoctrine()->getManager();
            $saveNews->persist($news);
            $saveNews->flush();
            $message = 'New edit.';
            return $this->render('authorize/successMessage.html.twig', array(
                'message' => $message,
                'routName' => 'news',
            ));
        }
        return $this->render('news/createNews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/news", name="news")
     */
    public function viewTitleNewsAction(Request $request, int $page = 1)
    {
        $newsPost = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getNewsSearchByIndexPageCategory($page);
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $paginator = $this->get('knp_paginator');
        $news = $paginator->paginate(
            $newsPost,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );

        return $this->render('news/news.html.twig', array(
            'News' => $news,
            'categories' => $categories,

        ));
    }

    /**
     * @Route("/news/id/{idNews}/{idAuthor}", name="oneNews")
     */
    public function viewNewsAction(Request $request, int $idNews = 1, int $idAuthor)
    {
        $countPage = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getCountPage();
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->find($idNews);
        $news->setViewCount();
        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getOneNewsSearchByIdAuthor($idNews, $idAuthor);
        return $this->render('news/newsId.html.twig', array(
            'news' => $news,
            'categories' => $categories,
            'countPage' => $countPage,
        ));
    }

    /**
     * @Route("/news/category/{category}/{page}", name="newsCategory")
     */
    public function viewTitleNewsCategoryAction(Request $request, string $category, int $page = 1)
    {
             $newsPost = $this->getDoctrine()->getRepository('AppBundle:DataNews')
            ->getNewsSearchByIndexPageCategory($page, $category);
        $categories = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')
            ->findAll();
        $paginator = $this->get('knp_paginator');
        $news = $paginator->paginate(
            $newsPost,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );

        return $this->render('news/news.html.twig', array(
            'News' => $news,
            'categories' => $categories,
        ));
    }
}