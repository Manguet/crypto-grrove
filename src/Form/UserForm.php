<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserForm extends AbstractType
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
            ->add('pseudo', TextType::class, [
                'label'    => 'Pseudo : ',
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('userAccount', TextType::class, [
                'label'    => 'Account * : ',
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Account'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit',
                'attr'  => [
                    'class' => 'btn-save'
                ]
            ])
        ;

        if (empty($options['data']->getAvatarName())) {
            $builder
                ->add('upload_file', FileType::class, [
                    'label'       => false,
                    'mapped'      => false,
                    'required'    => false,
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
                ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}