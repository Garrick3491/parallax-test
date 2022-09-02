<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FileUploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use League\Csv\Reader;
use Ramsey\Uuid\Uuid;
use App\Upload\Validation\FileValidator;
use League\Flysystem\FilesystemOperator;
use App\Data\DeviceRow;
use Symfony\Component\Messenger\MessageBusInterface;

class UploadController extends AbstractController
{

    public function __construct(private MessageBusInterface $messageBus)
    {}

    #[Route('/upload', name: 'app_upload')]
    public function index(Request $request, EntityManagerInterface $em, FileValidator $validator, FilesystemOperator $defaultStorage): Response
    {
        $file = new File();
        $form = $this->createForm(FileUploadType::class, $file);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $uploadedFile = $form->get('file')->getData();
            $destination = $this->getParameter('kernel.project_dir').'/var/storage/temp';
            $uniqueName = UUID::uuid4();
            $stream = fopen($uploadedFile->getRealPath(), 'r+');
            $defaultStorage->writeStream('/temp/' . $uniqueName . '.' . $uploadedFile->guessExtension(), $stream);
            fclose($stream);

            // dd($uploadedFile->move($destination, $uniqueName . '.csv'));
            $csv = Reader::createFromPath($destination . '/' . $uniqueName . '.' . $uploadedFile->guessExtension());
            $csv->setHeaderOffset(0);
            $isValid = $validator->validateCsv($csv);
           
            if (!$isValid)
            {
                $this->addFlash('error', 'CSV is Invalid! please check headers!');
            }
            else{
                
                foreach ($csv as $row)
                {
                    $device = DeviceRow::make($row);
                    $this->messageBus->dispatch($device);
                }

                $file->setLocation('/var/storage/temp' . $uniqueName . '.' . $uploadedFile->guessExtension());
                $file->setUploaded(new \DateTime('now'));
                $em->persist($file);
                $em->flush();
            }
        }

        return $this->renderForm('upload/index.html.twig', [
            'form' => $form,
        ]);
    }
}
