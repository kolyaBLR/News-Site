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
     * @Route("/document", name = "document")
     */
    public function documentDownloadAction(Request $request)
    {
        $file = new DataFile();
        $form = $this->createForm(DocumentType::class, $file);
        $form->add('Отправить', SubmitType::class);
        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
            if ($form->isSubmitted() && $form->isValid()) {
                var_dump($form);
                $em = $this->getDoctrine()->getManager();
                $em->persist($file);
                $em->flush();
            }
        }
        return $this->render("document/documentDownload.html.twig",array(
            'form' => $form->createView(),
        ));
    }
}