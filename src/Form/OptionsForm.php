<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OptionsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['options'] as $optionName => $optionData) {
            $type  = array_key_first($optionData);
            $label = str_replace(' ', '_', $optionName);

            if ($type === 'bool') {
                $builder
                    ->add($label, CheckboxType::class, [
                        'label'    => $optionName,
                        'required' => false,
                        'mapped'   => false,
                        'data'     => $options['optionRegistered']
                            ? $options['optionRegistered']->{'get' . str_replace(' ', '', $optionName)}()
                            : $optionData[$type],
                    ]);
            }

            if ($type === 'choices') {
                $builder
                    ->add($label, ChoiceType::class, [
                        'label'    => $optionName,
                        'required' => true,
                        'choices'  => $optionData[$type],
                        'data'     => $options['optionRegistered']
                            ? $options['optionRegistered']->{'get' . str_replace(' ', '', $optionName)}()
                            : 'en'
                    ]);
            }

            if ($type === 'keypress') {
                $value = $options['keyPress'][$optionData[$type]];

                $builder
                    ->add($label, ChoiceType::class, [
                        'label'    => $optionName,
                        'required' => true,
                        'choices'  => array_flip($options['keyPress']),
                        'data'     => $options['optionRegistered']
                            ? $options['optionRegistered']->{'get' . str_replace(' ', '', $optionName)}()
                            : array_search($value, $options['keyPress'], true)
                    ]);
            }

            $builder
                ->add('save', SubmitType::class, [
                    'label' => 'Submit',
                    'attr'  => [
                        'class' => 'btn-save'
                    ]
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
            'data_class'       => null,
            'options'          => null,
            'keyPress'         => null,
            'optionRegistered' => null,
        ]);
    }
}