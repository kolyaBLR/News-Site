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

class NewsController extends Controller
{
    public function createAction(Request $request)
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
}