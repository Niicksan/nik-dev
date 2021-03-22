<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'required' => TRUE,
                    'label' => 'Вашето име',
                    'attr' => [
                        'placeholder' => 'Вашето име',
                        'class' => 'form-control',
                    ],
                    'label_attr' => [
                        'class' => 'col-sm-6 control-label',
                    ],
                ]
            )
            ->add('email',EmailType::class, [
                'required' => TRUE,
                'label' => 'Вашият email',
                'attr' => [
                    'placeholder' => 'Вашият email',
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'col-sm-6 control-label',
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => TRUE,
                'label' => 'Вашето съобщение',
                'attr' => [
                    'placeholder' => 'Вашто съобщение',
                    'class' => 'form-control',
                    'rows' => '6',
                ],
                'label_attr' => [
                    'class' => 'col-sm-7 control-label',
                ],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Contact'
        ));
    }
}