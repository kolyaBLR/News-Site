<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DataFile;
use AppBundle\Form\DocumentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DocumentController extends Controller
{
    /**
     * @Route("/download/document", name = "download")
     */
    public function documentDownloadAction(Request $request)
    {
        $file = new DataFile();
        $form = $this->createForm(DocumentType::class, $file);
        $form->add('Отправить', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($file);
            $em->flush();
            $file->getFile()->move(
                $this->getParameter('brochures_directory'),
                $file->getName()
            );
        }

        return $this->render("document/documentDownload.html.twig",array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/documents", name = "documents")
     */
    public function documensAction(Request $request)
    {
        $files = $this->getDoctrine()
            ->getRepository('AppBundle:DataFile')
            ->findAll();
        return $this->render("document/documents.html.twig",array(
            'files' => $files
        ));
    }
}