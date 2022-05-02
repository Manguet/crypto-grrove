<?php

namespace App\Controller\Admin;

use App\Entity\Stage;
use App\Form\Admin\StageType;
use App\Traits\File\FileDurationTrait;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/836367321/stages', name: 'admin_stage')]
class StageController extends AbstractController
{
    use FileDurationTrait;

    public function __construct(private ?KernelInterface$kernel, private ?EntityManagerInterface $entityManager) {}

    #[Route('', name: '')]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('title', TextColumn::class, [
                'label'     => 'Titre',
                'orderable' => true,
            ])
            ->add('duration', TextColumn::class, [
                'label'     => 'Durée',
                'orderable' => true,
            ])
            ->add('HightScore', TextColumn::class, [
                'label'     => 'Meilleur Score',
                'orderable' => true,
            ])
            ->add('playedQuantity', TextColumn::class, [
                'label'     => 'Nombre de parties',
                'orderable' => true,
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Stage::class,
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('admin/stage/index.html.twig', [
            'datatable' => $table
        ]);
    }

    #[Route('/new', name: '_new')]
    public function new(Request $request): Response
    {
        $stage = new Stage();

        $form = $this->createForm(StageType::class, $stage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $music = $form['music']->getData();
            $image = $form['imageFile']->getData();

            $fileName = $music->getClientOriginalName();
            $stage->setMusic($fileName);
            $music->move($file = $this->kernel->getProjectDir() . '/public/sounds/', $fileName);
            $stage->setDuration($this->calculateFileSize($file . $fileName));

            $imageName = $image->getClientOriginalName();
            $stage->setImageFile($imageName);
            $image->move($this->kernel->getProjectDir() . '/public/medias/stages/', $imageName);

            $this->entityManager->persist($stage);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_stage');
        }

        return $this->render('admin/stage/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}