<?php

namespace App\Form\Admin;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class StageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'    => 'Titre du stage *',
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Titre du stage * '
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label'       => 'Image de fond de stage * ',
                'required'    => true,
                'mapped'      => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => "This document isn't valid.",
                    ])
                ],
            ])
            ->add('music', FileType::class, [
                'label'      => 'Musique * ',
                'required'   => true,
                'mapped'     => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit',
                'attr'  => [
                    'class' => 'btn-save'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}