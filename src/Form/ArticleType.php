<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Заглавие',
                'attr' => [
                    'placeholder' => 'Заглавие',
                    'name' => 'article[title]',
                    'class' => 'form-control',
                    'id' => 'article_title'
                ],

            ])
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Снимка',
                'attr' => [
                    'placeholder' => 'Снимка',
                    'name' => 'article[imageFile]',
                    'class' => 'form-control',
                    'id' => 'article_image'
                ],
            ])
            ->add('isFound', ChoiceType::class, [
                'required' => true,
                'label' => 'Изгубен/Намерен',
                'choices'  => [
                    'Изгубен' => 'Изгубен',
                    'Намерен' => 'Намерен'
                ],
                'attr' => [
                    'name' => 'article[isFound]',
                    'class' => 'form-control',
                    'id' => 'isFound'
                ],
            ])
            ->add('town', TextType::class, [
                'required' => true,
                'label' => 'Град',
                'attr' => [
                    'placeholder' => 'Град',
                    'name' => 'article[town]',
                    'class' => 'form-control',
                    'id' => 'article_town'
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => true,
                'label' => 'Телефон',
                'attr' => [
                    'placeholder' => 'Телефон',
                    'name' => 'article[phone]',
                    'class' => 'form-control',
                    'id' => 'article_phone'
                ],
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Описание',
                'attr' => [
                    'placeholder' => 'Описание',
                    'name' => 'article[content]',
                    'class' => 'form-control',
                    'id' => 'article_content'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Добави',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
        /*->add('dateAdded')
        ->add('authorId')
        ->add('author')*/
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Article'
        ));
    }
}