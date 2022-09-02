<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FileUploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/upload', name: 'app_upload')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $file = new File();
        $form = $this->createForm(FileUploadType::class, $file);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $uploadedFile = $form->get('file')->getData();
            dump($uploadedFile);
        }

        return $this->renderForm('upload/index.html.twig', [
            'form' => $form,
        ]);
    }
}
