<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/836367321', name: 'admin_')]
class UserController extends AbstractController
{
    #[Route('/users', name: 'user')]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('pseudo', TextColumn::class, [
                'label'     => 'Pseudo',
                'orderable' => true,
            ])
            ->add('userAccount', TextColumn::class, [
                'label'     => 'Account',
                'orderable' => true,
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => User::class,
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('admin/user/index.html.twig', [
            'datatable' => $table
        ]);
    }
}