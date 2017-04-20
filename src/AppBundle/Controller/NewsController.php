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
     * Здесь будет сохраняться уже написаннаня статься
     * тут расскажешь мне как работать с ролями
     * что бы ограничить достук юзерам
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
     * Здесь должен выводиться список новостей
     * на данный момент здесь выводятся все новости
     * параметры списка новостей:
     * Заголовок новости и его изображение
     * так же id для формирвоания ссылки
     * (Я это пока не могу сделать так как до сих пор мучаюсь с PDO драйвером)
     * @Route("/news")
     */
    public function viewTitleNewsAction(Request $request)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataNews')->findAll();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $newsJson = $serializer->serialize($news, 'json');
        return new Response(var_dump($newsJson));
    }

    /**
     * Здесь будет выводитсья одна стотья по её идентификатору
     * @Route("/news/{id}")
     * @ParamConverter("post", class="AppBundle:DataNews")
     */
    public function viewNewsAction(DataNews $newsId)
    {
        $news = $this->getDoctrine()->getRepository('AppBundle:DataUser')
            ->find($newsId);
        if (!$newsId) {
            throw $this->createNotFoundException('Not found by ID ' .$newsId);
        }
        return new Response($news);
    }
}